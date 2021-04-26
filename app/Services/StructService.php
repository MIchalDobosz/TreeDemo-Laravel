<?php

namespace App\Services;

use App\Models\Struct;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;

class StructService {

    private $struct;
    private $root;

    public function __construct() {
        
        $this->struct = Struct::all();
        $this->root = $this->findRoot();
    }


    public function findById($id) {

        return Struct::find($id);
    }

    public function structToHtmlList($currentItem): string
    {

        if (!is_object($currentItem)) {
            foreach($this->struct as $item) {
                if ($item->id == $currentItem) {
                    $currentItem = $item;
                    break;
                }
            }
        }

        $placeholder = "Rename";

        if ($currentItem->id == $this->root->id) {
            $return = '<li id="li' .$currentItem->id. '" class="liItem"><a href="/struct/' . $currentItem->id . '">' . $currentItem->name . '</a>
                <input id="fold' . $currentItem->id . '" type="button" class="fold btn btn-secondary btn_change" onclick="fold(' . $currentItem->id . ')" value="Fold">
                <input id="sort' . $currentItem->id . '" type="button" class="fold btn btn-secondary btn_change" onclick="sort(' . $currentItem->id . ')" value="Sort ASC"></a>
                <input id="optionsToggle' . $currentItem->id . '" type="button" class="optionsToggle btn btn-secondary btn_change" onclick="displayOptions(' . $currentItem->id . ')" value="Options">
                <form action="/struct/' . $currentItem->id . '/edit" method="post" style="display: inline">
                <input id="id' . $currentItem->id . '" class="id" type="text" name="id" value="' . $currentItem->id . '" style="display: none">
                <input id="editInput' . $currentItem->id . '" class="editInput" type="text" name="editInput" placeholder="'.$placeholder.'" style="display: none">
                <input id="editSubmit' . $currentItem->id . '" class="editSubmit btn btn-primary btn_change" type="submit" value="Update" style="display: none"></form>
                <form action="/struct/' . $currentItem->id . '/create" method="post" style="display: inline">
                <input id="idNew' . $currentItem->id . '" class="idNew" type="text" name="idNew" value="' . $currentItem->id . '" style="display: none">
                <input id="newInput' . $currentItem->id . '" class="newInput" type="text" name="newInput" placeholder="Enter name" style="display: none">
                <input id="newSubmit' . $currentItem->id . '" class="newSubmit  btn btn-success btn_change" type="submit" value="Add" style="display: none"></form>
                </li>';
        } else {
            $options = '';
            $nodeIds = explode(",", $this->nodeToString($currentItem));

            foreach ($this->struct as $item) {
                if (!in_array($item->id, $nodeIds) && $item->id != $currentItem->parent_id) {
                    $options .= '<option value="' . $item->id . '">' . $item->name . '</option>';
                }
            }

            $return = '<li id="li' .$currentItem->id. '" class="liItem"><a href="/struct/' . $currentItem->id . '">' . $currentItem->name . '</a>
                <input id="fold' . $currentItem->id . '" type="button" class="fold btn btn-secondary btn_change" onclick="fold(' . $currentItem->id . ')" value="Fold">
                <input id="sort' . $currentItem->id . '" type="button" class="fold btn btn-secondary btn_change" onclick="sort(' . $currentItem->id . ')" value="Sort ASC"></a>
                <input id="optionsToggle' . $currentItem->id . '" type="button" class="optionsToggle btn btn-secondary btn_change" onclick="displayOptions(' . $currentItem->id . ')" value="Options">
                <form action="/struct/' . $currentItem->id . '/edit" method="post" style="display: inline">
                <input id="id' . $currentItem->id . '" class="id" type="text" name="id" value="' . $currentItem->id . '" style="display: none">
                <input id="editInput' . $currentItem->id . '" class="editInput" type="text" name="editInput" placeholder="'.$placeholder.'" style="display: none">
                <select id ="editSelect' . $currentItem->id . '" class="editSelect" name="editSelect" style="display: none"><option value="" selected disabled hidden>Change parent</option>' . $options . '</select>
                <input id="editSubmit' . $currentItem->id . '" class="editSubmit  btn btn-primary btn_change" type="submit" value="Update" style="display: none"></form>
                <form action="/struct/' . $currentItem->id . '/delete" method="post" style="display: inline">
                <input id="idDelete' . $currentItem->id . '" class="idDelete" type="text" name="idDelete" value="' . $currentItem->id . '" style="display: none">
                <input id="delete' . $currentItem->id . '" type="submit" style="display: none" value="Delete" class=" btn btn-danger btn_change"></form>
                <form action="/struct/' . $currentItem->id . '/create" method="post" style="display: inline">
                <input id="idNew' . $currentItem->id . '" class="idNew" type="text" name="idNew" value="' . $currentItem->id . '" style="display: none">
                <input id="newInput' . $currentItem->id . '" class="newInput" type="text" name="newInput" placeholder="Enter name" style="display: none">
                <input id="newSubmit' . $currentItem->id . '" class="newSubmit  btn btn-success btn_change" type="submit" value="Add" style="display: none"></form></li>';
        }

        $childCheck = 0;
        foreach ($this->struct as $item) {
            if ($item->parent_id == $currentItem->id) {
                if ($childCheck == 0) {
                    $return .= '<ul id="ul' . $item->parent_id . '">';
                    $childCheck = 1;
                }
                $return .= $this->structToHtmlList($item);
            }
        }
        if ($childCheck == 1) {
            $return .= "</ul>";
        }

        return $return;
    }


    public function nodeToString($currentItem): string
    {

        $return = "";
        foreach ($this->struct as $item) {
            if ($item->parent_id == $currentItem->id) {
                $return .= $this->nodeToString($item).",";
            }
        }
        $return .= $currentItem->id;
        return $return;

    }


    public function findRoot() {

        foreach($this->struct as $item) {
            if ($item->parent_id == null) {
                return $item;
            }
        }
    }


    public function edit($itemId) {

        Request::validate([
            'editInput' => 'alpha_dash|nullable|max:64',
            'editSelect' => 'nullable'
        ]);

        $item = $this->findById($itemId);
        $name = request('editInput');
        $parent_id = request('editSelect');

        if ($name != null) {
            $item->name = $name;
        }
        if ($parent_id != null) {
            $item->parent_id = $parent_id; 
        }
        $item->save();
    }

    
    public function delete($itemId) {

        $currentItem = "";
        foreach ($this->struct as $item) {
            if ($item->id == $itemId) {
                $currentItem = $item;
            }
        }
        $deletionString = $this->nodeToString($currentItem);
        $deletionArray = explode(',', $deletionString);
        foreach ($deletionArray as $id) {
            Struct::destroy($id);
        }
    }


    public function create($parentId) {

        Request::validate([
            'newInput' => 'alpha_dash|nullable|max:64',
        ]);

        $name = request('newInput');
        $item = new Struct();
        $item->name = $name;
        $item->parent_id = $parentId;
        $item->save();
    }
}
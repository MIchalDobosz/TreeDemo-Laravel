<?php

namespace App\Http\Controllers;

use App\Models\Struct;
use Illuminate\Http\Request;
use App\Services\StructService;

class StructController extends Controller
{

    private $structService;

    public function __construct(StructService $structService) {
        
        $this->structService = $structService;
    }
    
    
    public function index() {
        
        $rootId = $this->structService->findRoot()->id;
        return redirect('/struct/'.$rootId);
    }

    public function show($id) {
        
        $list = '<ul>';
        $list .= $this->structService->structToHtmlList($id).'</ul>';
        return view('struct', ['list' => $list]);
    }

    public function edit($id) {

        $this->structService->edit($id);
        return redirect('/struct');
    }

    public function delete($id) {

        $this->structService->delete($id);
        return redirect('/struct');
    }

    public function create($id) {

        $this->structService->create($id);
        return redirect('/struct');
    }
}

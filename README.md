# TreeDemo-Laravel

Projekt realizuje mechanizm zarządzania strukturą drzewiastą.

Wykorzystana baza danych to PostgreSQL, w aplikacji przygotowane są migracje oraz seedy.

Na stronie głównej wyświetla się całe drzewo, z tego miejsca możemy:
- wejść w poszczególne węzły po kliknięciu na ich nazwę
- !! po najechaniu na nazwę węzłą wyświetli nam się przycisk "Fold", po którego kliknięciu zwijamy lub rozwijamy dany węzeł !!
- !! po najechaniu na nazwę węzłą wyświetli nam się przycisk "Sort", po którego kliknięciu sortujemy wybrany poziom drzewa rosnąco lub malejąco !!
- po najechaniu na nazwę węzłą wyświetli nam się przycisk "Options", po którego kliknięciu uzyskamy dostęp do opcji
- po wpisaniu nazwy w pole "Rename" i kliknięciu "Update" nastąpi zmiana nazwy (zaimplementowana jest walidacja, która nie przepuszcza żadnych znaków specjalnych)
- po wybraniu opcji z pola "Change parent" i kliknięciu "Update" nastąpi zmiana rodzica (przeniesienie).
- można jednocześnie zmienić nazwę i przenieść węzeł
- po wybraniu opcji "Delete" nastąpi usunięcie węzła
- po wpisaniu nazwy w pole "Enter name" i kliknięciu "Add" nastąpi dodanie nowego węzła (zaimplementowana jest walidacja, która nie przepuszcza żadnych znaków specjalnych)

Nie ma możliwości usuwania ani przenoszenia korzenia drzewa.

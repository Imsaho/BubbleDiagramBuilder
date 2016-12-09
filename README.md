BubbleDiagramBuilder - aplikacja służąca do przechowywania danych na temat koncepcji budynków, ich edytowania, dodawania, z możliwościa pracy zespołowej nad projektem.

Funckjonalności:

- dodawanie nowego użytkownika. Użytkownik może utworzyć zespół do pracy nad projektem. Ma możliwość dodawania do zespołu innych użytkowników, tym samym umozliwiając im modyfikacje w projekcie.
Wykorzystane zostało tutaj Symfony Voters (sprawdzanie, czy dany użytkownik posiada uprawnienia do modyfikowania danych treści) / w trakcie opracowania;

- użytkownik może dodać nowy projekt, określić podstawowe parametry budynku, ogólne dane, wymagane na samym początku pracy nad projektem;

- budynek ma strukturę drzewiastą i poszczególne jego części są w sobie zagnieżdżone (np. na budynek składają się kondygnacje, kondygnacje złożone są z pomieszczeń itp.). Menu aplikacji i nawigacja odpowiada tej strukturze;

- użytkownik może dodawać dowolną ilość kondygnacji;

- użytownik może dodawać dowolną illość stref (np. strefa techniczna, strefa komunikacji, strefa biurowa...);

- w ramach każdej kondygnacji / strefy użytkownik może dodawać dowolną ilość pomieszczeń, określając dla nich podstawowe parametry: powierzchnię, ilość osób mogących przebywać w tym pomieszczeniu;

- dla budowania relacji pomiędzy pomieszczeniami, dla pomieszczenia istnieje możliwość określenia, z jakimi innymi pomieszczeniami się ono łączy (została tu wykorzystana relacja ManyToMany self-referencing);

- /w trakcie opracowania/ - na podstawie wprowadzonych danych możliwość tworzenia prostych wykresów dla budynków, pokazujących np. udział powierzchni technicznej w całkwoitej powierzchni budynku itp.


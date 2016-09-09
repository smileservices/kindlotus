@extends('layouts.app')
@section('content')
@include('misc.header')

<div class="container">

    <h1>Functionare</h1>
    <p>Kindlotus.org este un proiect open source si poate fi folosit gratuit de catre oricine.</p>
    <h2>Organizatiile</h2>
    <p>Acceptam doar organizatiile care au experienta in organizarea cu succes a proiectelor umanitare. Doar acestea pot adauga si/sau administra cauzele care apar pe Kindlotus.org. Conturile organizatiilor sunt administrate de catre admin. Organizatiile care doresc sa foloseasca Kindlotus.org sunt rugate sa ne trimita un mesaj prin formularul de contact. Utilizarea platformei nu implica nici un cost.</p>
    <h2>Cauzele</h2>
    <p>Marcheaza locurile in care exista nevoie de ajutor. Contin pe langa titlu, o descriere sumara, o descriere ampla, pot fi adaugate fotografii, fisiere video, localizarea pe harta si datele de contact. Inainte de a fi publicate trebuie sa fie aprobate de catre admin. Fiecare cauza este etichetata dupa tipul sau (casa de copii, camin de batrani, adapost de catei, etc) si dupa tipul de ajutor cerut (alimente, rechizite scolare, materiale de constructii, etc). Aceasta permite utilizatorilor sa filtreze cautarile.
       Doar utilizatorii care s-au implicat intr-o cauza pot vedea datele de contact si adauga noutati (update-uri) despre cum au ajutat, ce nevoi mai exista in acea cauza si fotografii/filme.
    </p>
    <h2>Cautarea</h2>
    <p>Utilizatorii pot cauta printre cauzele active folosind filtre pentru tipul cauzelor si a nevoilor. Rezultatele cautarilor sunt pozitionate pe harta.</p>
    <h2>Implicarea in cauze</h2>
    <p>Utilizatorii se pot implica intr-o cauza apasand butonul „Implica-te” din josul paginii oricarei cauze. Va aparea o fereastra care va cere conectarea la contul de voluntar de pe Kindlotus.org. Cea mai simpla modalitate de conectare este de a folosi contul de Facebook. Daca utilizatorul nu este deja inregistrat, acestuia i se va crea un cont nou. Un utilizator poate sa fie implicat in mai multe cauze odata.
       Doar utilizatorii implicati pot vedea datele de contact ale cauzelor si pot posta noutati despre acestea. Rugam toti utilizatorii sa respecte regulile elementare de decenta si respect.
    </p>

</div>
@endsection
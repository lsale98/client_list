<div id="navigation">
    <h2>Saša Stojanović</h2>
    <ul id="list" class="list-group">
        <li class="list-group-item {{ (request()->is('/')) ? 'active' : '' }}">
            <a href="/" class="button"><i class="fas fa-users"></i>Lista klijenata</a>
        </li>
        <li class="list-group-item {{ (request()->is('user/create')) ? 'active' : '' }}">
            <a href="/user/create" class="button"><i class="fas fa-user-plus"></i>Dodajte klijenta</a>
        </li>
    </ul>
</div>

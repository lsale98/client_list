<div id="navigation">
    <h2>Saša Stojanović</h2>
    <ul id="list" class="list-group">
        <a href="/" class="button">
            <li class="list-group-item {{ (request()->is('/')) ? 'active' : '' }}">
                <i class="fas fa-users"></i>Lista klijenata
            </li>
        </a>

        <a href="/user/create" class="button">
            <li class="list-group-item  {{ (request()->is('user/create')) ? 'active' : '' }}">
                <i class="fas fa-user-plus"></i>Dodajte klijenta
            </li>
        </a>
    </ul>
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
    @csrf
</form>

<a href="#" 
   onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
   class="logout-button">
   Cerrar Sesión
</a>
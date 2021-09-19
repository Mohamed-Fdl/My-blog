<h3 class="sidebar-title">Search</h3>
<div class="sidebar-item search-form">
    <form action="{{route('search')}}" method="post">
        @csrf
        <input type="text" name="q" value={{request()->q}}>
        <button type="submit"><i class="bi bi-search"></i></button>
    </form>
</div>

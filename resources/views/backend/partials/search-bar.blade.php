<div class="search">
    <form id="searchForm" action="{{ $searchRoute }}" method="GET">
        <input id="search" class="input-search" type="search" name="search" value="{{ $search ?? '' }}" placeholder="Search...">
    </form>
</div>
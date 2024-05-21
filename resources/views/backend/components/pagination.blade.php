<div class="dataTable-footer">
    <div class="info">Showing {{ $items->firstItem() }} to {{ $items->lastItem() }} of {{ $items->total() }} entries</div>
    {{ $items->links('vendor.pagination.custom') }}
</div>
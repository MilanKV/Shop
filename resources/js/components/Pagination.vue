<template>
    <div class="row pagination">
        <nav>
            <ul>
                <li v-if="pagination.current_page > 1">
                    <a href="#" class="pointer" @click.prevent="changePage(pagination.current_page - 1)"
                        :disabled="pagination.current_page <= 1">
                        <span class="pagination-prev">
                            <img src="../../img/icons/arrow-left.svg">
                            Prev
                        </span>
                    </a>
                </li>
                <li v-for="page in totalPages" :key="page">
                    <a href="#" class="pointer" :class="{ active: page === pagination.current_page }"
                        @click.prevent="changePage(page)">
                        {{ page }}
                    </a>
                </li>
                <li v-if="pagination.current_page < pagination.last_page">
                    <a href="#" class="pointer" @click.prevent="changePage(pagination.current_page + 1)"
                        :disabled="pagination.current_page >= pagination.last_page">
                        <span class="pagination-next">
                            Next
                            <img src="../../img/icons/arrow-right.svg">
                        </span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
export default {
    name: 'Pagination',
    props: {
        pagination: {
            type: Object,
            required: true
        }
    },
    computed: {
        totalPages() {
            return Array.from({ length: this.pagination.last_page }, (_, i) => i + 1);
        }
    },
    methods: {
        changePage(page) {
            if (page > 0 && page <= this.pagination.last_page) {
                this.$emit('page-changed', page);
                this.$nextTick(() => {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            }
        }
    }
};
</script>
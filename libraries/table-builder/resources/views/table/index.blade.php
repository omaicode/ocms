@php
    $table_container_id = "table_".substr(\Illuminate\Support\Str::uuid(), 0, 8);
@endphp

<div id="{{ $table_container_id }}">
    @include("omc::table.{$theme}.table")
</div>

@push('scripts')
<script>    
    (function() {
        const {defineComponent, ref, reactive, createApp, watch, onMounted} = Vue;
        const data = {!! $table->getJsonTable() !!};
        const app = createApp(defineComponent({
            name: 'TableBuilder',
            setup() {
                const columns        = ref(data.columns),
                    items            = ref(data.items),
                    last_page        = ref(data.last_page),
                    total            = ref(data.total),
                    first_item       = ref(data.first_item),
                    last_item        = ref(data.last_item),
                    queryParams      = reactive(data.queryParams),
                    options          = ref(data.options),
                    per_page_options = ref([5, 10, 25, 50, 75, 100]),
                    table_loading    = ref(false),
                    search_timer     = ref(null),
                    isComponentLoaded = ref(false),
                    handlePageChange = function() {
                        table_loading.value = true
                        axios.get('{{ request()->url() }}', {params: queryParams})
                        .then(function(resp) {
                            if(resp.status == 200 && resp.data.success) {
                                items.value = resp.data.data.items
                                last_page.value = resp.data.data.last_page
                                total.value = resp.data.data.total
                                first_item.value = resp.data.data.first_item
                                last_item.value = resp.data.data.last_item
                            }
                        })
                        .finally(function() {
                            table_loading.value = false
                        })
                    };

                watch(
                    function() {
                        return queryParams.search
                    },
                    function() {
                        clearTimeout(search_timer.value);
                        search_timer.value = setTimeout(function() {
                            handlePageChange()
                        }, 500)
                    }
                );

                onMounted(function() {
                    isComponentLoaded.value = true
                })
                
                return {
                    columns,
                    items,
                    last_page,
                    total,
                    queryParams,
                    options,
                    handlePageChange,
                    first_item,
                    last_item,
                    per_page_options,
                    table_loading,
                    isComponentLoaded
                }
            }
        }));

        app.component('Paginate', window.Paginate)
        app.mount('#{{$table_container_id}}')
    })()
</script>
@endpush
<template>
    <index-screen title="Barang" resource="products">
        <tr slot="table-header">
            <th scope="col">Id</th>
            <th scope="col">Deskripsi</th>
            <th scope="col">Harga</th>
            <th scope="col"></th>
        </tr>

        <template slot="row" slot-scope="slotProps">
            <td class="table-fit pr-0">
                <span class="badge font-weight-light">
                    {{slotProps.entry.id}}
                </span>
            </td>

            <td class="table-fit">
                <span class="badge font-weight-light">
                    {{slotProps.entry.description}}
                </span>
            </td>

            <td class="table-fit">
                <span class="badge font-weight-light">
                    {{slotProps.entry.price}}
                </span>
            </td>

            <td class="table-fit">
                <router-link :to="{name:'products-preview', params:{id: slotProps.entry.id}}" class="control-action">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 16">
                        <path d="M16.56 13.66a8 8 0 0 1-11.32 0L.3 8.7a1 1 0 0 1 0-1.42l4.95-4.95a8 8 0 0 1 11.32 0l4.95 4.95a1 1 0 0 1 0 1.42l-4.95 4.95-.01.01zm-9.9-1.42a6 6 0 0 0 8.48 0L19.38 8l-4.24-4.24a6 6 0 0 0-8.48 0L2.4 8l4.25 4.24h.01zM10.9 12a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"></path>
                    </svg>
                </router-link>
                <router-link :to="{name:'products-preview', params:{id: slotProps.entry.id}}" class="control-action">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M10.185,1.417c-4.741,0-8.583,3.842-8.583,8.583c0,4.74,3.842,8.582,8.583,8.582S18.768,14.74,18.768,10C18.768,5.259,14.926,1.417,10.185,1.417 M10.185,17.68c-4.235,0-7.679-3.445-7.679-7.68c0-4.235,3.444-7.679,7.679-7.679S17.864,5.765,17.864,10C17.864,14.234,14.42,17.68,10.185,17.68 M10.824,10l2.842-2.844c0.178-0.176,0.178-0.46,0-0.637c-0.177-0.178-0.461-0.178-0.637,0l-2.844,2.841L7.341,6.52c-0.176-0.178-0.46-0.178-0.637,0c-0.178,0.176-0.178,0.461,0,0.637L9.546,10l-2.841,2.844c-0.178,0.176-0.178,0.461,0,0.637c0.178,0.178,0.459,0.178,0.637,0l2.844-2.841l2.844,2.841c0.178,0.178,0.459,0.178,0.637,0c0.178-0.176,0.178-0.461,0-0.637L10.824,10z"></path>
                    </svg>
                </router-link>
            </td>
        </template>

    </index-screen>
</template>

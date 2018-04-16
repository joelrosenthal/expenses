<template>
    <vuetable
            :fields="columns"
            api-url="/api/expenditures"
            :http-fetch="fetchData"
    ></vuetable>
</template>

<script>
    var moment = require('moment');
    export default {
        data() {
            return {
                subcategories: {},
                sources: {},
                columns: [
                    'id',
                    'Date',
                    'Location',
                    'Amount',
                    'Subcategory',
                    'Source',
                    'Comments'
                ]
            }
        },
        methods: {
        fetchData: function (apiUrl, httpOptions) {
            return window.axios.get(apiUrl, httpOptions)
        },
        transform: function (data) {
            let responseData = {
                data: []
            };

            responseData.data = data.data.map(function (record) {
                return {
                    'id': record.id,
                    'Date': moment(record.datetime).format("dddd, MMMM Do YYYY, h:mm:ss a"),
                    'Location': record.location,
                    'Amount': record.amount,
                    'Subcategory': record.subcategory.name,
                    'Source': record.source.name,
                    'Comments': record.comments,
                };
            });
            return responseData;
        }

        },

    }
</script>

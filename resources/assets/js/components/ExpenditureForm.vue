<template>
    <div class="container">
        <el-form ref="form" :model="form" :rules="rules" label-width="120px">
            <div class="col-md-6">
                <el-form-item label="Date and Time">
                    <el-date-picker
                            v-model="form.datetime"
                            type="datetime"
                            format="yyyy-MM-dd HH:mm:ss"
                            placeholder="Select date and time"
                            id="form-datetime"
                            :picker-options="pickerOptions"
                    >
                    </el-date-picker>
                </el-form-item>
            </div>
            <div class="col-md-6">
                <el-form-item label="Amount">
                    <el-input v-model="form.amount"
                              id="amount"
                              :step="0.01"
                              :controls="false"
                              type="number"
                    />
                </el-form-item>
            </div>
            <div class="col-md-6">
                <el-form-item label="Location">
                    <el-input v-model="form.location"
                              id="location"/>
                </el-form-item>

            </div>
            <div class="col-md-6">
                <el-form-item label="Category">
                    <el-cascader
                            :options="categories"
                            :props="props"
                            v-model="form.subcategory_id"
                            id="subcategory-select"
                    >
                    </el-cascader>
                </el-form-item>
            </div>
            <div class="col-md-6">
                <el-form-item label="Source">
                    <el-select v-model="form.source_id" id="source-select">
                        <el-option
                                v-for="source in sources"
                                :key="source.id"
                                :label="source.name"
                                :value="source.id"
                        >
                        </el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="Comments">
                    <el-input type="textarea"
                              v-model="form.comments"
                              id="comments"/>
                </el-form-item>
            </div>
            <el-button type="primary" @click="create">Create</el-button>
            <el-button type="primary" @click="update" v-if="this.expenditure_id !== null">update</el-button>
        </el-form>
    </div>
</template>

<script>
    export default {
        props: {
            expenditure_id: {
                default: null,
                required: false
            }
        },
        data() {
            return {
                form: {
                    id: 0,
                    datetime: '',
                    amount: 0.00,
                    location: '',
                    comments: '',
                    category_id: '',
                    subcategory_id: [0,0],
                    source_id: 0,

                },
                props: {
                    value: "id",
                    label: "name",
                    children: "subcategories",
                },
                subcategories: [],
                categories: [],
                sources: [],
                pickerOptions: {
                    shortcuts: [{
                        text: 'Today',
                        onClick(picker) {
                            picker.$emit('pick', new Date());
                        }
                    }]

                },
                rules:{
                    location: [
                        { required: true, message: 'Remember the location', trigger: 'blur' },
                    ]
                }
            }
        },
        methods: {
            validate() {
                this.$refs.form.validate((valid) => {
                    if (valid) {
                        alert('submit!');
                    }
                })
            },
            transformForSave() {
                let formFields = this.form;
                formFields.subcategory_id = formFields.subcategory_id[1];
                formFields.datetime = this.moment(this.form.datetime).format('YYYY-MM-DD HH:mm:ss');
                return formFields;

            },
            create() {
                this.validate();
                let formFields = this.transformForSave();
                axios.post('/api/expenditures', formFields)
                  .then(function(response) {
                     console.log(response.data.data)
                  })
            },
            update() {
                let formFields = this.transformForSave();
                formFields._method = 'PUT';
                axios.post('/api/expenditures/' + this.expenditure_id, formFields)
                    .then(function(response) {
                        console.log(response.data.data)
                    })
            },
        },
        mounted() {
            axios.get('/api/categories')
                .then(response => {
                    this.categories = response.data.data;
                });
            axios.get('/api/subcategories')
                .then(response => {
                    this.subcategories= response.data.data;
                });
            axios.get('/api/sources')
                .then(response => {
                    this.sources = response.data.data;
                });
            if (this.expenditure_id !== null) {
                axios.get('/api/expenditures/' + this.expenditure_id)
                    .then(response => {
                        let subcategory = this.subcategories.find(subcategory => subcategory.id === response.data.data.subcategory_id);
                        this.form= response.data.data;
                        this.form.subcategory_id= [subcategory.category_id, subcategory.id];
                    });

            }
        }
    }
</script>

<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Book</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="create">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Book Name</label>
                                    <input type="text" class="form-control" v-model="book.book_name">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Book author_name</label>
                                    <input type="text" class="form-control" v-model="book.author_name">
                                </div>
                            </div>
                            
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label for="image">Book Image</label>
                                    <input type="file" class="form-control" ref="imageFile">
                                   
                                </div>
                            </div>

                            <div class="col-12 mb-2">
                                <div class="form-group">
                                <label for="published_date">Published Date</label>
                                <input
                                    type="date"
                                    class="form-control"
                                    id="published_date"
                                    v-model="book.published_date"
                                    required
                                />
                                </div>
                            </div>

                            <div class="col-12 mb-2">
                                <div class="form-group">
                                <label for="description">Description</label>
                                <textarea
                                    class="form-control"
                                    id="description"
                                    rows="4"
                                    v-model="book.description"
                                ></textarea>
                                </div>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import axios from 'axios';
export default {
    name: "add-book",
    data(){
        return {
            book: {
                book_name: '',
                author_name: '',
                book_image: '',
                published_date: '',
                description: '',
            },
        }
    },
    methods:{
        async create(){
            let formData = new FormData();
            formData.append('book_name', this.book.book_name);
            formData.append('author_name', this.book.author_name);
            formData.append('published_date', this.book.published_date);
            formData.append('description', this.book.description);
            
            // Append the image file
            if(this.$refs.imageFile && this.$refs.imageFile.files[0]){
                formData.append('book_image', this.$refs.imageFile.files[0]);
            }

            await this.axios.post('/api/books', formData).then(response => {
                this.$router.push({name:"booksList"});
            }).catch(error => {
                console.log(error);
            });
        }

    }
}
</script>
<template>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Book Details</h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-4">
                <img :src="getFullImageUrl(book.book_image)" alt="Book Image" style="width: 200px; height: 200px;">

              </div>
              <div class="col-8">
                <h5>{{ book.book_name }}</h5>
                <p><strong>Author:</strong> {{ book.author_name }}</p>
                <p><strong>Published Date:</strong> {{ book.published_date }}</p>
                <p><strong>Description:</strong> {{ book.description }}</p>
                <router-link :to="{ name: 'booksEdit', params: { id: book.id } }" class="btn btn-success">Edit</router-link>
                <button type="button" @click="deleteBook(book.id)" class="btn btn-danger mx-2">Delete</button>
                <router-link :to="{ name: 'booksList' }" class="btn btn-secondary">Back to List</router-link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    name: 'booksShow',
    data() {
      return {
        book: {},
      };
    },
    mounted() {
      this.getBook();
    },
    methods: {

    getFullImageUrl(imagePath) {
      return `/storage/${imagePath}`; 
    },


      async getBook() {
        try {
          const { data } = await axios.get(`/api/books/${this.$route.params.id}`);
          this.book = data;
        } catch (error) {
          console.log(error);
        }
      },
  
      async deleteBook(id) {
        if (confirm('Are you sure to delete this book?')) {
          try {
            await axios.delete(`/api/books/${id}`);
            this.$router.push({ name: 'booksList' });
          } catch (error) {
            console.log(error);
          }
        }
      },
    },
  };
  </script>
  
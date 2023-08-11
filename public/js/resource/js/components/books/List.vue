<template>
    <div class="row">
      <div class="col-12 mb-2 text-end">
        <router-link :to="{ name: 'booksAdd' }" class="btn btn-primary">Create New Book</router-link>
      </div>
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Books</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Book Name</th>
                    <th>Author Name</th>
                    <th>Published Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody v-if="books.length > 0">
                  <tr v-for="book in books" :key="book.id">
                    <td>{{ book.id }}</td>
                    <td>{{ book.book_name }}</td>
                    <td>{{ book.author_name }}</td>
                    <td>{{ book.published_date }}</td>
                    <td>
                      <router-link :to="{ name: 'booksEdit', params: { id: book.id } }" class="btn btn-success">Edit</router-link>
                      <router-link :to="{ name: 'booksShow', params: { id: book.id } }" class="btn btn-info mx-2">Show</router-link>
                      <button type="button" @click="deleteBook(book.id)" class="btn btn-danger">Delete</button>
                    </td>
                  </tr>
                </tbody>
                <tbody v-else>
                  <tr>
                    <td colspan="5" align="center">No Books Found.</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    name: 'books',
    data() {
      return {
        books: [],
      };
    },
    mounted() {
      this.getBooks();
    },
    methods: {
      async getBooks() {
        try {
          const response = await axios.get('/api/books');
          this.books = response.data;
        } catch (error) {
          console.error(error);
          this.books = [];
        }
      },
  
      async deleteBook(id) {
        if (confirm('Are you sure to delete this book?')) {
          try {
            await axios.delete(`/api/books/${id}`);
            this.getBooks();
          } catch (error) {
            console.log(error);
          }
        }
      },
    },
  };
  </script>
  
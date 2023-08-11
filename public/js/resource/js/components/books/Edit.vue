<template>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Update Book</h4>
          </div>
          <div class="card-body">
            <form @submit.prevent="update">
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
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </div>                        
            </form>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: "update-books",
    data() {
      return {
        book: {
          book_name: '',
          author_name: '',
          book_image: '',
          published_date: '',
          description: '',
          _method: "PATCH"
        }
      };
    },
    mounted() {
      this.showBooks();
    },
    methods: {
      async showBooks() {
        try {
          const response = await this.axios.get(`/api/books/${this.$route.params.id}`);
          const { book_name, author_name, book_image, published_date, description } = response.data;
          this.book.book_name = book_name;
          this.book.author_name = author_name;
          this.book.book_image = book_image;
          this.book.published_date = published_date;
          this.book.description = description;
        } catch (error) {
          console.log(error);
        }
      },
      async update() {
        try {
          await this.axios.post(`/api/books/${this.$route.params.id}`, this.book);
          this.$router.push({ name: "booksList" });
        } catch (error) {
          console.log(error);
        }
      }
    }
  };
  </script>
  
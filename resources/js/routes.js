const Welcome = () => import('./components/Welcome.vue')
const BooksList = () => import('./components/books/List.vue')
const BooksCreate = () => import('./components/books/Add.vue')
const BooksEdit = () => import('./components/books/Edit.vue')
const BooksShow = () => import('./components/books/Show.vue')

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Welcome
    },
   
    {
        name: 'booksList',
        path: '/books',
        component: BooksList
    },

    {
        name: 'booksEdit',
        path: '/books/:id/edit',
        component: BooksEdit
    },

    {
        name: 'booksAdd',
        path: '/books/add',
        component: BooksCreate
    },


    {
        name: 'booksShow',
        path: '/books/:id/show',
        component: BooksShow
    },

]
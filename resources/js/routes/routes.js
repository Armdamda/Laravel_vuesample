import Home from '../views/Home.vue'
import About from '../views/About.vue'
import Contact from '../views/Contact.vue'
import StudentIndex from '../views/students/Index.vue'
import StudentNew from '../views/students/Form.vue'

export default [
  { path: '/', component: Home },
  { path: '/about', component: About },
  { path: '/contact', component: Contact },
  { path: '/students', component: StudentIndex },
  { path: '/students/new', component: StudentNew },
]
import Home from "../views/Home.vue";
import About from "../views/About.vue";
import Contact from "../views/Contact.vue";
import ListStudent from "../views/students/ListStudent.vue";
import CreateStudent from "../views/students/CreateStudent.vue";
import EditStudent from "../views/students/EditStudent.vue";
import ShowStudent from '../views/students/ShowStudent.vue';
import CreateClass from '../views/Classes/CreateClass.vue'
import ListClass from '../views/Classes/ListClass.vue';
import EditClass from '../views/Classes/EditClass.vue';
import ShowClass from '../views/Classes/ShowClass.vue';
import ListTeacher from '../views/Teachers/ListTeacher.vue';
import CreateTeacher from '../views/Teachers/CreateTeacher.vue';
import EditTeacher from '../views/Teachers/EditTeacher.vue';
import ListSubject from '../views/Subjects/ListSubject.vue';
import EditSubject from '../views/Subjects/EditSubject.vue';
import CreateSubject from '../views/Subjects/CreateSubject.vue';
import ShowSubject from '../views/Subjects/ShowSubject.vue';
import ShowTeacher from '../views/Teachers/ShowTeacher.vue';

export default [
  {
    path: "/",
    name: "home",
    component: Home,
  },
  {
    path: "/about",
    name: "about",
    component: About,
  },
  {
    path: "/contact",
    name: "contact",
    component: Contact,
  },
  {
    path: "/students",
    name: "students",
    component: ListStudent,
  },
  {
    path: "/students/new",
    name: "students.new",
    component: CreateStudent,
  },
  {
    path: "/students/:id",
    name: "students.edit",
    component: EditStudent,
  },
  {
    path: "/student/:id",
    name: "student.show",
    component: ShowStudent,
  },
  {
    path:"/classes",
    name:"classes",
    component: ListClass
  },
  {
    path:"/create/class",
    name:"create.class",
    component:CreateClass
  },
  {
    path: "/students/:id",
    name: "students.edit",
    component: EditStudent,
  },
  {
    path:"/class/:id",
    name:"class.edit",
    component: EditClass
  },

  {
    path:"/show/:id",
    name:"class.show",
    component: ShowClass
  },
  //Teacher route
  {
    path:'/teachers',
    name:'teachers',
    component: ListTeacher
  },
  {
    path: '/teachers/new',
    name: 'createTeacher',
    component: CreateTeacher
  },
  {
      path:'/teachers/show/:id',
      name:'teachers.show',
      component: ShowTeacher
  },
  {
    path: "/teachers/:id",
    name: "teachers.edit",
    component: EditTeacher,
  },
 //Subjects route:
 {
    path:'/subjects',
    name:'subjects',
    component: ListSubject
 },
 {
  path: "/subjects/new",
  name: "subjects.new",
  component: CreateSubject
},
 {
    path:'/subjects/:id',
    name:'subjects.edit',
    component: EditSubject
 },
 {
    path:'/subjects/show/:id',
    name: 'subjects.show',
    component: ShowSubject
 }

];
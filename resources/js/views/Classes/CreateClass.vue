<template>
  <div class="bg-gray-50 px-10 py-2 rounded-md my-2 w-[80%] m-auto">
    <h2 class="text-2xl font-medium mb-4">New Class</h2>
    <form @submit.prevent="addClass">
      <div class="mb-3">
        <label class="block text-gray-700 font-medium mb-2">Class</label>
        <input placeholder="New Class" v-model="classroom.name"
          class="border p-2 py-3 w-full rounded-lg text-gray-700 outline-none focus:border-gray-300 focus:shadow-md"
          required />
      </div>
      <!-- <div class="mb-3">
        <label class="block text-gray-700 font-medium mb-2">Subject</label>
        <select v-model="classroom.subject"
          class="border text-base font-medium p-2 py-3 w-full text-gray-700 rounded-lg outline-none focus:border-gray-300 focus:shadow-md">
          <option value="0">Select Subject</option>
          <option v-for="subject in subjects" :value="subject.id">
            {{ subject.name }}
          </option>
        </select>
      </div> -->

      <div class="-mx-3 flex flex-wrap">
        <div class="w-full px-3 sm:w-1/2">
          <div class="mb-3">
            <label class="block text-gray-700 font-medium mb-2">Subject</label>
            <select v-model="classroom.subject" @change="handleChange"
              class="border text-base font-medium p-2 py-3 w-full text-gray-700 rounded-lg outline-none focus:border-gray-300 focus:shadow-md">
              <option value="0">Select Subject</option>
              <option v-for="subject in subjects" :value="subject.id">
                {{ subject.name }}
              </option>
            </select>
          </div>
          <div class="mb-3">
            <select v-model="classroom.subject1" @change="handleChange1"
              class="border text-base font-medium p-2 py-3 w-full text-gray-700 rounded-lg outline-none focus:border-gray-300 focus:shadow-md">
              <option value="0">Select Subject</option>
              <option v-for="subject in subjects" :value="subject.id">
                {{ subject.name }}
              </option>
            </select>
          </div>
          <div class="mb-3">
            <select v-model="classroom.subject2" @change="handleChange2"
              class="border text-base font-medium p-2 py-3 w-full text-gray-700 rounded-lg outline-none focus:border-gray-300 focus:shadow-md">
              <option value="0">Select Subject</option>
              <option v-for="subject in subjects" :value="subject.id">
                {{ subject.name }}
              </option>
            </select>
          </div>
        </div>
        <!-- selection Teacher -->
        <div class="w-full px-3 sm:w-1/2">
          <div class="mb-3">
            <label class="block text-gray-700 font-medium mb-2">Teacher</label>
            <select v-model="classroom.teacher"
              class="border text-base font-medium p-2 py-3 w-full text-gray-700 rounded-lg outline-none focus:border-gray-300 focus:shadow-md">
              <option value="0">Select Teacher</option>
              <option v-for="teacher in teachers" :value="teacher.id">
                {{ teacher.name }}
              </option>
            </select>
          </div>
          <div class="mb-3">
            <select v-model="classroom.teacher1"
              class="border text-base font-medium p-2 py-3 w-full text-gray-700 rounded-lg outline-none focus:border-gray-300 focus:shadow-md">
              <option value="0">Select Teacher</option>
              <option v-for="teacher in teachers1" :value="teacher.id">
                {{ teacher.name }}
              </option>
            </select>
          </div>
          <div class="mb-3">
            <select v-model="classroom.teacher2"
              class="border text-base font-medium p-2 py-3 w-full text-gray-700 rounded-lg outline-none focus:border-gray-300 focus:shadow-md">
              <option value="0">Select Teacher</option>
              <option v-for="teacher in teachers2" :value="teacher.id">
                {{ teacher.name }}
              </option>
            </select>
          </div>
        </div>
      </div>
      <div class="ml-[90.6%]">
        <button type="button" class="bg-gray-600 text-white px-3 py-2 rounded-md">
          <RouterLinK to=""> + add More</RouterLinK>
        </button>
      </div>

      <div class="mb-3">
        <button class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-600 justify-start">
          Save
        </button>
      </div>
    </form>
  </div>
</template>
<script setup>
import axios from 'axios';
import {ref,reactive }  from  'vue'
import { onMounted } from 'vue'
import { useRoute,useRouter } from 'vue-router';

const errors = ref(' ')
const router = useRouter;
const route = useRoute()
const classroom = reactive({
        name: "",
        subject: "",
        subject1: "",
        subject2: "",
        teacher: "",
        teacher1: "",
        teacher2: "",
})
const subjects =ref([])
const teachers= ref([])
const teachers1= ref([])
const teachers2= ref([])

onMounted(()=>{
  getSubject()
  getTeacher()
})

const getSubject = async ()=>{
  let res = await axios.get(`/api/subjects`)
  subjects.value = res.data
}

const getTeacher = async()=>{
  let res = await axios.get(`/api/classes`)
  teachers.value = res.data
}

const handleChange=async ()=>{
  errors.value='  '
  try {
   let res= await axios.get(`/api/subjects/${classroom.subject}/teachers`)
    teachers.value =res.data
  } catch (error) {
    if(error.res.status === 422){
    for(const key in error.res.data.errors){
      errors.value = error.res.data.errors
    }
  }
  }
}

const handleChange1=async ()=>{
  errors.value='  '
  try {
   let res= await axios.get(`/api/subjects/${classroom.subject1}/teachers`)
    teachers1.value =res.data
  } catch (error) {
    if(error.res.status === 422){
    for(const key in error.res.data.errors){
      errors.value = error.res.data.errors
    }
  }
  }
}

const handleChange2=async ()=>{
  errors.value='  '
  try {
   let res= await axios.get(`/api/subjects/${classroom.subject2}/teachers`)
    teachers2.value =res.data
  } catch (error) {
    if(error.res.status === 422){
    for(const key in error.res.data.errors){
      errors.value = error.res.data.errors
    }
  }
  }
}

const addClass = async () =>{
  errors.value = "  "
  try {
  let res = await axios.post(`/api/classes`,classroom);
    await router.push({name: ' classes'})
  } catch (error) {
    if(error.res.status === 422){
    for(const key in error.res.data.errors){
      errors.value = error.res.data.errors
    }
  }
  }
}

// export default {
//   data() {
//     return {
//       classroom: {
//         name: "",
//         subject: "",
//         subject1: "",
//         subject2: "",
//         teacher: "",
//         teacher1: "",
//         teacher2: "",
//       },

//       subjects: [],
//       teachers: [],
//       teachers1: [],
//       teachers2: [],
//     };
//   },

//   mounted() {
//     this.getSubject();
//     //this.getTeacher()
//   },

//   methods: {
//     getSubject() {
//       axios
//         .get(`/api/subjects`)
//         .then((res) => {
//           this.subjects = res.data;
//         })
//         .catch((error) => console.log(error))
//         .finally(() => (this.loading = false));
//     },
//     getTeacher() {
//       axios
//         .get(`/api/teachers`)
//         .then((res) => {
//           this.teachers = res.data;
//         })
//         .catch((error) => console.log(error))
//         .finally(() => (this.loading = false));
//     },
//     handleChange() {
//       axios
//         .get(`/api/subjects/${this.classroom.subject}/teachers`)
//         .then((res) => {
//           this.teachers = res.data
//         })
//         .catch((error) => console.log(error))
//         .finally(() => (this.loading = false));
//     },
//     handleChange1() {
//       axios
//         .get(`/api/subjects/${this.classroom.subject1}/teachers`)
//         .then((res) => {
//           this.teachers1 = res.data;
//         })
//         .catch((error) => console.log(error))
//         .finally(() => (this.loading = false));
//     },
//     handleChange2() {
//       axios
//         .get(`/api/subjects/${this.classroom.subject2}/teachers`)
//         .then((res) => {
//           this.teachers2 = res.data;
//         })
//         .catch((error) => console.log(error))
//         .finally(() => (this.loading = false));
//     },

//     //add all data to table
//     addClass() {
//       axios
//         .post(`/api/classes`, this.classroom)
//         .then((res) => {
//           console.log(res.data);
//           this.$router.push({ name: "classes" });
//         })
//         .catch((error) => console.log(error))
//         .finally(() => (this.loading = false));
//     },
//   },
// };
</script>

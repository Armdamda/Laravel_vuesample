<template>
  <div class="bg-gray-50 px-10 py-2 rounded-md my-2  w-[80%] m-auto">
    <h2 class="text-2xl font-medium mb-4">Update Class</h2>
    <form @submit.prevent="UpdateClass">
      <div class="mb-3">
        <label class="block text-gray-700 font-medium mb-2">Class</label>
        <input placeholder="New Class" v-model="classroom.name"
          class="border p-2 py-3 w-full rounded-lg text-gray-700 outline-none focus:border-gray-300 focus:shadow-md"   required
           />
      </div>
      <div class="-mx-3 flex flex-wrap">
              <div class="w-full px-3 sm:w-1/2">
                <div class="mb-3">
                  <label class="block text-gray-700 font-medium mb-2">Subject</label>             
                <select  v-model="classroom.subject"
                    @change="handleChange" 
                  class="border text-base font-medium p-2 py-3 w-full text-gray-700 rounded-lg outline-none focus:border-gray-300 focus:shadow-md">
                  <option value="0">Select Subject</option>
                  <option v-for="subject in subjects" :value="subject.id">
                    {{ subject.name }}
                  </option>
                </select>
              </div> 
              <div class="mb-3">                       
                <select   v-model="classroom.subject1"
                @change="handleChange1" 
                  class="border text-base font-medium p-2 py-3 w-full text-gray-700 rounded-lg outline-none focus:border-gray-300 focus:shadow-md">
                  <option value="0">Select Subject</option>
                  <option v-for="subject in subjects" :value="subject.id">
                    {{ subject.name }}
                  </option>
                </select>
              </div>  
              <div class="mb-3">                       
                <select  v-model="classroom.subject2"
                @change="handleChange2" 
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
                  <select  v-model="classroom.teacher"
                    class="border text-base font-medium p-2 py-3 w-full text-gray-700 rounded-lg outline-none focus:border-gray-300 focus:shadow-md">
                    <option value="0">Select Teacher</option>
                    <option v-for="teacher in teachers" :value="teacher.id">
                      {{ teacher.name }}
                    </option>
                  </select>
                </div> 
                <div class="mb-3">                  
                <select   v-model="classroom.teacher1"
                  class="border text-base font-medium p-2 py-3 w-full text-gray-700 rounded-lg outline-none focus:border-gray-300 focus:shadow-md">
                  <option value="0">Select Teacher</option>
                  <option v-for="teacher in teachers1" :value="teacher.id">
                      {{ teacher.name }}
                    </option>
                </select>
              </div>  
              <div class="mb-3">                       
                <select   v-model="classroom.teacher2"
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
        <button type="button" class="bg-gray-600 text-white  px-3 py-2 rounded-md ">
       <RouterLinK to=""> + add More</RouterLinK>
        </button>
      </div>

      <div class="mb-3">
        <button class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-600 justify-start ">
          Update
        </button>
      </div>
    </form>
  </div>
</template>
<script>
import axios from 'axios';

export default {
  data() {
    return {
      classroom: {
        name: "",
        subject: "",
        subject1: "",
        subject2:"" ,
        teacher: '',
        teacher1: '',
        teacher2: '',    
      },
      classrooms:[],
      subjects: [],
      teachers:[],
      teachers1:[],
      teachers2:[],
    };
  },

  async mounted()
   {
    this.getSubject()
    //this.getTeacher()
    await this. getClassroom()
     this. handleChange(this.classroom.subject)
     this.handleChange1(this.classroom.subject1)
     this.handleChange2(this.classroom.subject2)
  },

  methods: {
    async getClassroom(){
      await axios 
            .get(`/api/classes/${this.$route.params.id}`)
            .then((res)=>{
              this.classroom.name = res.data.data.name,
              this.classroom.subject = res.data.data.subjects[0].id
              this.classroom.teacher = res.data.data.subjects[0].pivot.teacher_id
              this.classroom.subject1 = res.data.data.subjects[1].id
              this.classroom.teacher1 = res.data.data.subjects[1].pivot.teacher_id
              this.classroom.subject2 = res.data.data.subjects[2].id
              this.classroom.teacher2 = res.data.data.subjects[2].pivot.teacher_id
            })
            .catch((error) => console.log(error))
            .finally(() => (this.loading = false));
    },
  async  getSubject() {
      await  axios
        .get(`/api/subjects`)
        .then((res) => {
          this.subjects = res.data
        })
        .catch((error) => console.log(error))
        .finally(() => (this.loading = false));
    },

  async  getTeacher(){
       await   axios
              .get(`/api/teachers/${this.$route.params.id}`)
              .then((res)=>{
                this.teachers= res.data
              })
              .catch(error=>console.log(error))
              .finally(()=>this.loading= false)
      },

        handleChange(id) {
              axios 
                .get(`/api/subjects/${id}/teachers`)
                .then((res) => {
                 console.log(res.data)
                  this.teachers=  res.data
                })
                .catch(error => console.log(error))
                .finally(()=>this.loading = false) 
    }, 
      handleChange1(id) {
              axios 
                .get(`/api/subjects/${id}/teachers`)
                .then((res) => {
                  this.teachers1 =  res.data
                })
                .catch(error => console.log(error))
                .finally(()=>this.loading = false) 
    }, 
     handleChange2(id) {
              axios 
                .get(`/api/subjects/${id}/teachers`)
                .then((res) => {
                  this.teachers2 =  res.data
                })
                .catch(error => console.log(error))
                .finally(()=>this.loading = false) 
    }, 

    UpdateClass() {
      axios
        .put(`/api/classes/${this.$route.params.id}`, this.classroom)
        .then((res) => {
          this.$router.push({ name: "classes" });
        })
        .catch((error) => console.log(error))
        .finally(() => (this.loading = false));
    },
     
  },
};
</script>
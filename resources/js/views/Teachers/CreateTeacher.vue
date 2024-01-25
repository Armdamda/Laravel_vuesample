<template>

    <div class=" bg-gray-50 px-12 py-3 rounded-md m-auto w-[70%]">
      <h2 class="text-2xl font-medium mb-4">New Teacher</h2>
      <form @submit.prevent="createTeacher">
          <div class="mb-4">
              <label  class="block text-gray-700 font-medium mb-2">Name</label>
              <input type="text" v-model="teacher.name" placeholder="Username" class="border text-base font-medium border-gray-400 p-2 w-full rounded-lg text-gray-600 focus:outline-none focus:border-gray-400" required>
          </div>  
          <div class="-mx-3 flex flex-wrap">
              <div class="w-full px-3 sm:w-1/2">
                <div class="mb-4">
                      <label for="gender" class="block text-gray-700 font-medium mb-2">Subject</label>
                    <select   v-model="teacher.subject"  multiple
                        class="border text-base font-medium border-gray-400 p-2 w-full text-gray-600  rounded-lg focus:outline-none  focus:border-gray-400" >
                        <option value="0">Select subject</option>
                        <option v-for="subject in subjects" :value="subject.id">
                          {{ subject.name }}
                        </option>             
                    </select>
                </div>
              </div>
                  <div class="w-full px-3 sm:w-1/2">
                      <div class="mb-4">
                        <label for="gender" class="block text-gray-700 font-medium mb-2">Gender</label>
                        <select v-model="teacher.gender" 
                            class="border border-gray-400 p-2 w-full text-gray-600  rounded-lg text-base font-medium focus:outline-none  focus:border-gray-400" required>             
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                     </div>
                  </div>
              </div>
          <!-- date and Time -->
          <div class="-mx-3 flex flex-wrap">
                  <div class="w-full px-3 sm:w-1/2">
                      <div class="mb-5">
                          <label for="date" class="mb-3 block text-base font-medium text-gray-700">
                              Date
                          </label>
                          <input type="date" name="date" id="date"   v-model="teacher.created_at" 
                              class="w-full rounded-md border border-gray-400 bg-white py-2 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                      </div>
                  </div>
                  <div class="w-full px-3 sm:w-1/2">
                      <div class="mb-5">
                          <label for="time" class="mb-3 block text-base font-medium text-gray-700">
                              Time
                          </label> 
                          <input type="time" name="time" id="time"  v-model="teacher.updated_at"
                              class="w-full rounded-md border border-gray-400 bg-white py-2 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                      </div>
                  </div>
          </div>
          <div class="mb-6">
              <button  class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Submit</button>
          </div>
      </form>
  </div>
</template> 

<script setup>
   import axios from 'axios';
  import {ref, reactive }  from  'vue'
  import { useRouter} from 'vue-router'
  import { onMounted } from 'vue'
  
  const error = ref(" ")
  const subjects = ref([])
  const router = useRouter()
  const teacher= reactive({
    name:' ',
    gender:' ',
    subject:[]
  })

  onMounted(()=>{
    getSubject()
  })

  const getSubject  =async ()=>{
      let response = await axios.get(`/api/subjects`)
      subjects.value = response.data
  }

  const createTeacher = async () =>{
    error.value = "  "
    try {
      await axios.post(`/api/teachers`,teacher)
      await router.push({name:'teachers'})
    } 
    catch (error) {
      if(error.response.status === 422){
        for(let key in error.response.data.error){
          error.value = error.response.data.error
        }
      }
    }
  }
  // export default {
  //   data(){
  //     return{
  //       teacher:{
  //         'name': '  ',
  //         'gender': '  ',
  //         subject: [],
  //       },
  //       subjects:[]
  //     }
  //   },
  //   mounted(){ 
  //     this.getSubject()
  //   },
  
  //   methods:{
  //     getSubject(){
  //           axios
  //           .get('/api/subjects')
  //           .then((res) => {
  //             this.subjects = res.data
  //           })
  //           .catch(error => console.log(error))
  //           .finally(()=>this.loading = false)
  //     },
      
  //     addTeacher(){
  //         axios 
  //           .post(`/api/teachers`,this.teacher)
  //           .then((res)=>{
  //             console.log(res.data)
  //             this.$router.push({name: 'teachers'})
  //           })
  //           .catch(error=>console.log(error))
  //           .finally(()=>this.loading= false)
  //     }
  //   }
  // }
  </script>
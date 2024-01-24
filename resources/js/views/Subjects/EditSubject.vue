<template>
    <div class="bg-gray-50 px-12 py-2 m-auto rounded-md  mt-3  w-[50%]">
        <h2 class="text-2xl font-medium mb-4">Update Subject</h2>
        <form @submit.prevent="updatedSubject">
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Subject of Teacher:</label>          
                <input  v-model="subject.name"  class="border border-gray-400 p-2 w-full rounded-lg text-gray-600 focus:outline-none focus:border-gray-400" required  placeholder="new subject">
            </div>       
            <div class="mb-6">
                <button   class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Edit</button>
            </div>
        </form>
    </div>
</template>

  <script setup>
   import { ref,reactive} from 'vue'
   import { useRouter } from 'vue-router';
   import { onMounted} from 'vue'
import axios from 'axios';

const errors = ref(" ")
  const router = useRouter('')
  const subject = reactive({
    nane:' '
  })
  const subjects = ref([])

  onMounted(()=>{
    getSubject()
  })

  const getSubject = async()=>{
    let response = await axios.get(`/api/subjects/${id}`)
    subjects.value = response.data.data
  }

  const updatedSubject = async () =>{
      errors.value =" "
      try {
        await axios.patch(`/api/subjects`)
        await router.push({name:'subjects'})
      } 
      catch (error) {
        if(error.response.data.status === 422)
        {
          for(const key in errors.response.data){
            errors.value = errors.response.data
          }
        }
      }
  }

  // export default {
  //   data(){
  //     return{
  //       subject:{
  //         'name': '  '
  //       },
  //       subjects:[]
  //     }
  //   },
  //   mounted(){ 
  //       this.getSubject()
  //   },
  //   methods:{
  //       getSubject(){
  //         axios
  //             .get(`/api/subjects/${this.$route.params.id}`)
  //             .then((res)=>{
  //               this.subject.name= res.data.data.name
  //             })
  //             .catch(error=>console.log(error))
  //             .finally(()=>this.loading= false)
  //       },
  //       updateSubject(){ 
  //           axios 
  //           .put(`/api/subjects/${this.$route.params.id}`,this.subject)
  //           .then(res=>{
  //               console.log(res.data)
  //               this.$router.push({name: 'subjects'})
  //           })
  //           .catch(error=>console.log(error))
  //           .finally(()=>this.loading= false)
  //       }
  //   },
  // }


  </script>
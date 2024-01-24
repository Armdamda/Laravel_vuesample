<template>
    <div class="bg-gray-50 px-12 py-2 rounded-md  m-auto w-[70%]">
      <h2 class="text-2xl font-medium mb-4">Update Student</h2>
      <form @submit.prevent="updatedStudent">
          <div class="mb-4">
              <label  class="block text-gray-700 font-medium mb-2">Name</label>
              <input type="text" v-model="student.name" placeholder="Username" class="border text-base font-medium border-gray-400 p-2 w-full rounded-lg text-gray-600 focus:outline-none focus:border-gray-400" required>
          </div>    
          <div class="-mx-3 flex flex-wrap">
              <div class="w-full px-3 sm:w-1/2">
                <div class="mb-4">
          
                      <label for="gender" class="block text-gray-700 font-medium mb-2">Class</label>
                    <select v-model="student.classroom"
                        class="border text-base font-medium border-gray-400 p-2 w-full text-gray-600  rounded-lg focus:outline-none  focus:border-gray-400" >
                        <option value="0" >Select Class</option>
                        <option v-for="classroom in classrooms" :key="classroom.id" :value="classroom.id">
                            {{classroom.name}}                     
                        </option>             
                    </select>
                </div>
              </div>
                  <div class="w-full px-3 sm:w-1/2">
                      <div class="mb-4">
                        <label for="gender" class="block text-gray-700 font-medium mb-2">Gender</label>
                        <select v-model="student.gender"
                            class="border border-gray-400 p-2 w-full text-gray-600  rounded-lg text-base font-medium focus:outline-none  focus:border-gray-400" required>
                            <option value="0" >Select Gender</option>
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
                          <input type="date" name="date" id="date"
                              class="w-full rounded-md border border-gray-400 bg-white py-2 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                      </div>
                  </div>
                  <div class="w-full px-3 sm:w-1/2">
                      <div class="mb-5">
                          <label for="time" class="mb-3 block text-base font-medium text-gray-700">
                              Time
                          </label>
                          <input type="time" name="time" id="time"
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
    import { ref, reactive} from 'vue'
    import { onMounted } from 'vue';
    import { useRouter } from 'vue-router';
    
    const errors = ref('')
    const router = useRouter()
    const students = ref([])
    const classrooms = ref([])
  	const student= reactive({
        name: ' ',
        gender:' ',
        classroom: ' '
    })
    const props = defineProps({
    id: {
        required: true,
        type: String
    }
})
    onMounted(()=>{
        getClassroom()
        getStudent()
    })
    const getClassroom = async () =>{
        let response = await axios.get(`/api/classes`)
        classrooms.value = response.data
    }

    const getStudent = async () =>  {
        let res =await axios.get(`/api/student/${id}`)
            student.name = res.data.data.name
            student.gender = res.data.data.gender
            student.classroom = res.data.data.classroom.id
    } 

    const updatedStudent = async (id) =>{
        errors.value = ' '
        try {
            await axios.patch(`/api/students/${id}`,student)
            await router.push({name:'students'})
        } catch (e) {
            if(e.response.status === 422){
                for(const key in e.response.data.errors){
                     errors.value = e.response.data.errors
                }
            }
        }
    }

   
 
onMounted(() => getCompany(props.id))
 
const saveCompany = async () => {
    await updateCompany(props.id)
}



</script>
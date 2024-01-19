<template>
    <p class="mb-3 font-bold">Subject</p>
    <div  class="mb-3">
      <!-- <button class="bg-gray-600 hover:bg-gray-700 px-2 py-2 text-white rounded-md shadow text-xs">
        <RouterLink to="/subjects/new">New Subject</RouterLink>
      </button> -->
    </div>
      <div class="flex flex-col">
      <div class="-m-1.5 overflow-x-auto">
        <div class="p-1.5 min-w-full inline-block align-middle">
            <div class="overflow-hidden">
              <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">   
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                  <div class="flex flex-col">
                    <div class="-m-1.5 overflow-x-auto">
                      <div class="p-1.5 min-w-full inline-block align-middle">
                        <div class="border rounded-lg divide-y divide-gray-200">
                          <div class="overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200 ">
                              <thead class="bg-gray-500  ">
                                <tr class="text-center bg-gray-300">
                                  <th scope="col" class="py-3 px-4 pe-0">
                                    <div class="flex items-center h-5">
                                      <input id="hs-table-pagination-checkbox-all" type="checkbox" class="border-gray-200 rounded text-blue-600 focus:ring-blue-500   ">
                                      <label for="hs-table-pagination-checkbox-all" class="sr-only">Checkbox</label>
                                    </div>
                                  </th>                        
                                  <th scope="col" class="px-4 py-3  text-xs font-medium text-gray-800 uppercase">Subject</th>
                                  <th scope="col" class="px-4 py-3  text-xs font-medium text-gray-800 uppercase">Create At</th>
                                  <th scope="col" class="px-4 py-3  text-xs font-medium text-gray-800 uppercase">Update At</th>
                                  <th scope="col" class="px-4 py-3  text-xs font-medium text-gray-800 uppercase">Action</th>
                                </tr>
                              </thead>
                     
                              <tbody  class="divide-y divide-gray-200 " >
                                <tr  class="text-center"  v-for="(subject,index) in subjects" :key="index.id">                          
                                  <td class="py-3 p-4">
                                    <div class="flex items-center h-5">
                                      <input id="hs-table-pagination-checkbox-1" type="checkbox" class="border-gray-200 rounded text-blue-600 focus:ring-blue-500">
                                      <label for="hs-table-pagination-checkbox-1" class="sr-only">Checkbox</label>
                                    </div>
                                  </td>
                                 
                                  <td class="px-4 py-4  text-sm text-gray-800 dark:text-gray-200">{{ subject.name }}</td>  
                                  <td class="px-4 py-4  text-sm text-gray-800 dark:text-gray-200">{{ subject.created_at }}</td>
                                  <td class="px-4 py-4  text-sm text-gray-800 dark:text-gray-200">{{ subject.updated_at }}</td>           
                                  <td class="px-4 py-4  text-sm">
                                      <button 
                                          class="mr-3 text-sm bg-gray-400 hover:bg-gray-500 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">
                                          <RouterLink :to='{name:"subjects.edit",params:{id:subject.id}}'>Edit</RouterLink>                                       
                                      </button>
                                      <button 
                                          class="mr-3 text-sm bg-gray-400 hover:bg-gray-500 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">
                                          <RouterLink :to='{name:"subjects.show",params:{id: subject.id}}'>View</RouterLink>
                                      </button>
                                      <button  @click="deleteSubject(subject.id,index)" 
                                        class="text-sm bg-gray-500 hover:bg-gray-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">
                                          Delete                            
                                      </button>
                                  </td>
                                </tr>  
                              </tbody >
                            </table>
                          </div>
                          <div class="py-1 px-4">
                            <nav class="flex items-center space-x-1">
                              <button type="button" class="p-2.5 inline-flex items-center gap-x-2 text-sm rounded-full text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none ">
                                <span aria-hidden="true">«</span>
                                <span class="sr-only">Previous</span>
                              </button>
                              <button type="button" class="min-w-[40px] flex justify-center items-center text-gray-800 hover:bg-gray-100 py-2.5 text-sm rounded-full disabled:opacity-50 disabled:pointer-events-none " aria-current="page">1</button>
                              <button type="button" class="min-w-[40px] flex justify-center items-center text-gray-800 hover:bg-gray-100 py-2.5 text-sm rounded-full disabled:opacity-50 disabled:pointer-events-none ">2</button>
                              <button type="button" class="min-w-[40px] flex justify-center items-center text-gray-800 hover:bg-gray-100 py-2.5 text-sm rounded-full disabled:opacity-50 disabled:pointer-events-none ">3</button>
                              <button type="button" class="p-2.5 inline-flex items-center gap-x-2 text-sm rounded-full text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none ">
                                <span class="sr-only">Next</span>
                                <span aria-hidden="true">»</span>
                              </button>
                            </nav>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>  
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
</template>
    
<script >
    export default {
        data() {
             return {
                subjects: [],
                teachers:[]
            }
        },
        mounted() { 
            this.getSubject()
            this.getTeacher()
        },
        methods: {

          getTeacher(){
              axios
                    .get(`/api/teachers/${this.$route.params.id}`)
                    .then((res)=>{
                        console.log(res.data.data.subjects)
                      this.subjects= res.data.data.subjects
                    })
                    .catch(error => console.log(error))
                    .finally(()=> this.loading = false)
          },
            getSubject(){
                  axios
                    .get(`/api/subjects`)
                    .then(response => this.subjects= response.data)
                    .catch(error => console.log(error))
                    .finally(()=> this.loading = false)
            },

            deleteSubject(id, index) {
              axios
                .delete('/api/subjects/'+id)
                .then(() => {
                  this.subject.data.splice(index,1);
                })
                .catch((error) => {
                  console.log(error);
                });
            }     

            
        }   
    }   
    </script>
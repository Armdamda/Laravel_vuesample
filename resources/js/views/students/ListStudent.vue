<template>
  <p class="mb-3 font-bold">Student list</p>
  <div class="mb-3">
    <button class="bg-gray-600 hover:bg-gray-700 px-2 py-2 text-white rounded-md shadow text-xs">
      <RouterLink to="/students/new">Add new</RouterLink>
    </button>
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
                    <div class="border rounded-lg divide-y divide-gray-200 dark:border-gray-700 dark:divide-gray-700">
                      <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                          <thead class="bg-gray-50 dark:bg-gray-700 ">
                            <tr class="text-center">
                              <th scope="col" class="py-3 px-4 pe-0">
                                <div class="flex items-center h-5">
                                  <input id="hs-table-pagination-checkbox-all" type="checkbox"
                                    class="border-gray-200 rounded text-blue-600 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                  <label for="hs-table-pagination-checkbox-all" class="sr-only">Checkbox</label>
                                </div>
                              </th>
                              <th scope="col" class="px-4 py-3  text-xs font-medium text-gray-500 uppercase">Id</th>
                              <th scope="col" class="px-4 py-3  text-xs font-medium text-gray-500 uppercase">Name</th>
                              <th scope="col" class="px-4 py-3  text-xs font-medium text-gray-500 uppercase">Gender</th>
                              <th scope="col" class="px-4 py-3  text-xs font-medium text-gray-500 uppercase">Class</th>
                              <th scope="col" class="px-4 py-3  text-xs font-medium text-gray-500 uppercase">Create At
                              </th>
                              <th scope="col" class="px-4 py-3  text-xs font-medium text-gray-500 uppercase">Update At
                              </th>
                              <th scope="col" class="px-4 py-3  text-xs font-medium text-gray-500 uppercase">Action</th>
                            </tr>
                          </thead>

                          <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            <tr class="text-center" v-for="(student, index) in students" :key="index.id">
                              <td class="py-3 p-4">
                                <div class="flex items-center h-5">
                                  <input id="hs-table-pagination-checkbox-1" type="checkbox"
                                    class="border-gray-200 rounded text-blue-600 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                  <label for="hs-table-pagination-checkbox-1" class="sr-only">Checkbox</label>
                                </div>
                              </td>
                              <td class="px-4 py-4  text-sm text-gray-800 dark:text-gray-200">{{ student.id }}</td>
                              <td class="px-4 py-4  text-sm text-gray-800 dark:text-gray-200">{{ student.name }}</td>
                              <td class="px-4 py-4  text-sm text-gray-800 dark:text-gray-200">{{ student.gender }}</td>
                              <td class="px-4 py-4  text-sm text-gray-800 dark:text-gray-200">{{ student.classroom.name }}
                              </td>
                              <td class="px-4 py-4  text-sm text-gray-800 dark:text-gray-200">{{ student.created_at }}
                              </td>
                              <td class="px-4 py-4  text-sm text-gray-800 dark:text-gray-200">{{ student.updated_at }}
                              </td>
                              <td class="px-4 py-4  text-sm">
                                <button
                                  class="mr-3 text-sm bg-gray-400 hover:bg-gray-500 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">
                                  <RouterLink :to='{ name: "students.edit", params: { id: student.id } }'>Edit</RouterLink>
                                </button>
                                <button
                                  class="mr-3 text-sm bg-gray-400 hover:bg-gray-500 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">
                                  <RouterLink :to='{ name: "student.show", params: { id: student.id } }'>View</RouterLink>
                                </button>
                                <button @click="deleteStudent(student.id, index)"
                                  class="text-sm bg-gray-500 hover:bg-gray-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">
                                  Delete
                                </button>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <div class="py-1 px-4">
                        <nav class="flex items-center space-x-1">
                          <button type="button"
                            class="p-2.5 inline-flex items-center gap-x-2 text-sm rounded-full text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none ">
                            <span aria-hidden="true">«</span>
                            <span class="sr-only">Previous</span>
                          </button>
                          <button type="button"
                            class="min-w-[40px] flex justify-center items-center text-gray-800 hover:bg-gray-100 py-2.5 text-sm rounded-full disabled:opacity-50 disabled:pointer-events-none "
                            aria-current="page">1</button>
                          <button type="button"
                            class="min-w-[40px] flex justify-center items-center text-gray-800 hover:bg-gray-100 py-2.5 text-sm rounded-full disabled:opacity-50 disabled:pointer-events-none ">2</button>
                          <button type="button"
                            class="min-w-[40px] flex justify-center items-center text-gray-800 hover:bg-gray-100 py-2.5 text-sm rounded-full disabled:opacity-50 disabled:pointer-events-none ">3</button>
                          <button type="button"
                            class="p-2.5 inline-flex items-center gap-x-2 text-sm rounded-full text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none ">
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
<script setup>
import axios from 'axios';
import { onMounted } from 'vue';
import { ref } from 'vue';
import { useRouter } from 'vue-router';

const classrooms = ref([])
const students = ref([])
const router = useRouter()
const errors = ref(' ')

onMounted(() => {
  getStudent()
  getClassroom()
})

const getStudent = async () => {
  let response = await axios.get(`/api/students`)
  students.value = response.data
}

const getClassroom = async () => {
  let response = await axios.get(`/api/classes`)
  classrooms.value = response.data.classrooms
}

const deleteStudent = async (id) => {
  errors.value = '   '
  try {
    await axios.delete(`/api/students/${id}`)
    await router.push({ name: 'students' })
  } catch (error) {
    if (errors.response.status === 422) {
      for (const key in e.response.data.errors) {
        errors.value = e.response.data.errors
      }
    }
  }
}
</script>
<template>
    <div class="bg-gray-50 px-12 py-2 rounded-md w-[70%] m-auto">
        <h2 class="text-2xl font-medium mb-4">Student View</h2>
        <form>
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Name</label>
                <input type="text" v-model="student.name" disabled
                    class="border border-gray-400 p-2 w-full rounded-lg text-gray-600 focus:outline-none focus:border-gray-400"
                    required>
            </div>
            <div class="-mx-3 flex flex-wrap">
                <div class="w-full px-3 sm:w-1/2">
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">Class</label>
                        <select v-model="student.classroom" disabled
                            class="border text-base font-medium border-gray-400 p-2 w-full text-gray-600  rounded-lg focus:outline-none  focus:border-gray-400">
                            <option value="0">Select Class</option>
                            <option v-for="classroom in classrooms" :key="classroom.id" :value="classroom.id">
                                {{ classroom.name }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="w-full px-3 sm:w-1/2">
                    <div class="mb-4">
                        <label for="gender" class="block text-gray-700 font-medium mb-2">Gender</label>
                        <select v-model="student.gender" disabled
                            class="border border-gray-400 p-2 w-full text-gray-600  rounded-lg text-base font-medium focus:outline-none  focus:border-gray-400"
                            required>
                            <option value="0">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                </div>
            </div>

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
                <button class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
                    <RouterLink to="/students">Back</RouterLink>
                </button>

            </div>
        </form>
    </div>
</template> 
<script setup>
import axios from 'axios';
import { onMounted } from 'vue';
import { ref, reactive } from 'vue';
import { useRoute } from 'vue-router';


const route = useRoute()
const student = reactive({
    name: ' ',
    gender: ' ',
    classroom: ' '
})

const classrooms = ref([])
onMounted(() => {
    getClassroom()
    getStudent()
})

const getClassroom = async () => {
    let res = await axios.get(`/api/classes`)
    classrooms.value = res.data
}

const getStudent = async () => {
    let res = await axios.get(`/api/students/${route.params.id}`)
    student.name = res.data.data.name
    student.gender = res.data.data.gender
    student.classroom = res.data.data.classroom.id
}
</script>
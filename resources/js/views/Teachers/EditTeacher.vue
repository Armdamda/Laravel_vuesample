<template>
<div class=" bg-gray-50 px-12 py-3 roum  m-auto w-[70%]">
    <h2 class="text-2xl font-medium mb-4">Update Teacher</h2>
    <form @submit.prevent="updateTeacher">
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Name</label>
            <input type="text" v-model="teachers.name" placeholder="Username" class="border text-base font-medium border-gray-400 p-2 w-full rounded-lg text-gray-600 focus:outline-none focus:border-gray-400" required>
        </div>
        <div class="-mx-3 flex flex-wrap">
            <div class="w-full px-3 sm:w-1/2">
                <div class="mb-4">
                    <label for="gender" class="block text-gray-700 font-medium mb-2">Subject</label>
                    <select v-model="teachers.subject" multiple class="border text-base font-medium border-gray-400 p-2 w-full text-gray-600  rounded-lg focus:outline-none  focus:border-gray-400">
                        <option v-for="subject in subjects" :value="subject.id">
                            {{ subject.name }}
                        </option>
                    </select>
                </div>
            </div>
            <div class="w-full px-3 sm:w-1/2">
                <div class="mb-4">
                    <label for="gender" class="block text-gray-700 font-medium mb-2">Gender</label>
                    <select v-model="teachers.gender" class="border border-gray-400 p-2 w-full text-gray-600  rounded-lg text-base font-medium focus:outline-none  focus:border-gray-400" required>
                        <option value="0">Select Gender</option>
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
                    <input type="date" name="date" id="date" class="w-full rounded-md border border-gray-400 bg-white py-2 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                </div>
            </div>
            <div class="w-full px-3 sm:w-1/2">
                <div class="mb-5">
                    <label for="time" class="mb-3 block text-base font-medium text-gray-700">
                        Time
                    </label>
                    <input type="time" name="time" id="time" class="w-full rounded-md border border-gray-400 bg-white py-2 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                </div>
            </div>
        </div>
        <div class="mb-6">
            <button class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Submit</button>
        </div>
    </form>
</div>
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return {
            teachers: {
                'name': '   ',
                'gender': '   ',
                'subject': []
            },
            teachers: [],
            subjects: []
        }
    },
    mounted() {
        this.getTeacher()
        this.getSubject()
    },

    methods: {
        //show data from table teacher:
        getTeacher() {
            axios
                .get(`/api/teachers/${this.$route.params.id}`)
                .then((res) => {
                    this.teachers = res.data.data
                    this.teachers.subject = res.data.data?.subjects.map(item => item.id)
                })
                .catch(error => console.log(error))
                .finally(() => this.loading = false)
        },

        getSubject() {
            axios
                .get(`/api/subjects`)
                .then((res) => {
                    console.log(res.data)
                    this.subjects = res.data
                })
                .catch(error => console.log(error))
                .finally(() => this.loading = false)
        },

        updateTeacher() {
            axios
                .put(`/api/teachers/${this.$route.params.id}`, this.teachers)
                .then(res => {
                    this.$router.push({
                        name: 'teachers'
                    })
                })
                .catch(error => console.log(error))
                .finally(() => this.loading = false)
        }
    },
}
</script>

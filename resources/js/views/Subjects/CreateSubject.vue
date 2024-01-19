<template>

    <div class=" bg-gray-50 px-12 py-3 m-auto rounded-md w-[50%] ">
        <h2 class="text-2xl font-medium mb-4">New Subject</h2>
        <div class="mb-4">
                <label  class="block text-gray-700 font-medium mb-2">Subject</label>
                <input  v-model="subject.name"  class="border border-gray-400 p-2 w-full rounded-lg text-gray-600 focus:outline-none focus:border-gray-400" required placeholder="New Subject">
        </div>   
            <div class="mb-6">
                <button  @click="addSubjcet" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Save</button>
            </div>
    </div>
    
</template>
    
<script >
    export default {
        data(){
            return {
                subject:{
                    name: '',
                }
            }
        },
        methods:{
            addSubjcet(){
                axios
                    .post('/api/subjects', this.subject)
                    .then(response => {
                    console.log(response.data)
                    this.$router.push({name:'subjects'})
                    })
                    .catch((error) => {
                    console.log(error);
                    });
            }
        },
    }
</script>
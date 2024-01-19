<template>

<div class="flex h-screen bg-gray-100">

<!-- sidebar -->
<div class="hidden md:flex flex-col w-64 bg-blue-900">
    <div class="flex items-center justify-center h-12 bg-gray-900">
        <span class="text-white font-bold uppercase">Demo</span>
    </div>
    <div class="flex flex-col flex-1 overflow-y-auto">
        <nav class="flex-1 px-2 py-4 bg-gray-800">
            <RouterLink to="/" class="flex items-center px-4 py-2 text-gray-100 hover:bg-gray-200 hover:text-gray-600 rounded-md">
                Dashboard
            </RouterLink>
            <RouterLink to="/students" class="flex items-center px-4 py-2 mt-2 text-gray-100 hover:bg-gray-200 hover:text-gray-600 rounded-md">
                Student
            </RouterLink>
            <RouterLink to="/classes" class="flex items-center px-4 py-2 mt-2 text-gray-100 hover:bg-gray-200 hover:text-gray-600 rounded-md">
                Classes
            </RouterLink>
            <RouterLink to="/teachers" class="flex items-center px-4 py-2 mt-2 text-gray-100 hover:bg-gray-200 hover:text-gray-600 rounded-md">
                Teachers
            </RouterLink>
            <RouterLink to="/subjects" class="flex items-center px-4 py-2 mt-2 text-gray-100 hover:bg-gray-200 hover:text-gray-600 rounded-md">
                Subjects
            </RouterLink>
        </nav>
    </div>
</div>
        
<!-- Main content -->
<div class="flex flex-col flex-1 overflow-y-auto">
    <div class="flex items-center justify-between h-12 bg-gray-400 border-b border-gray-100">
        <div class="flex items-center px-4">
            <input class="mx-4 w-full  rounded-md px-4 py-1" type="text" placeholder="Search">
        </div>
        <div class=" text-center pr-20">
          <RouterLink to="/" class="text-sm mr-1 px-3 py-2 leading-none hover:text-white rounded-lg hover:bg-gray-600">
                Home
          </RouterLink>
          <RouterLink to="/about" class="text-sm mr-1 px-2 py-2 leading-none hover:text-white rounded-lg hover:bg-gray-600" >
                About
          </RouterLink>      
          <RouterLink to="/contact" class="text-sm mr-1 px-2 py-2 leading-none hover:text-white rounded-lg hover:bg-gray-600">
                Contact
          </RouterLink>   
          <RouterLink  to='#' class="text-sm mr-1 px-2 py-2 leading-none hover:text-white rounded-lg hover:bg-gray-600">
                Login
          </RouterLink>          
        </div>
        <div class="flex items-center px-4">
            <button class="text-gray-600 focus:outline-none focus:text-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>

    <div class="p-4">    
        <RouterView /> 
    </div>
</div>
</div>

</template>

<script setup>

</script>
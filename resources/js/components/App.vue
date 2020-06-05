<template>
  <div class="h-screen bgwhite">
    <div class="flex">
      <div class="pl-6 bg-gray-900 w-48 h-screen border-r-2">
        <nav class="pt-2">
          <p class="text-white text-3xl">
            <router-link
              class="hover:text-gray-300"
              style="text-decoration : none"
              to="/"
            >LarinstaJS</router-link>
          </p>

          <router-link style="text-decoration : none" to="/">
            <div>
              <p class="mt-5 text-pink-300 text-xl hover:text-white">All posts</p>
            </div>
          </router-link>
          <router-link style="text-decoration : none" to="/">
            <div>
              <p class="text-pink-400 text-xl hover:text-white">Create post</p>
            </div>
          </router-link>
          <router-link style="text-decoration : none" to="/">
            <div style="position:absolute; bottom:0;" class="mb-2">
              <p class="text-pink-500 text-xl hover:text-white">Logout</p>
            </div>
          </router-link>
        </nav>
      </div>

      <div class="flex flex-col flex-1 h-screen overflow-y-hidden">
        <div class="h-16 px-6 border-b border-gray-300 flex items-center justify-between">
          <div>Posts</div>
          <div>Search</div>
        </div>
        <div class="flex flex-col overflow-y-hidden flex-1">
          <router-view class="p-6 overflow-x-hidden"></router-view>
        </div>
      </div>
    </div>
  </div>
</template>
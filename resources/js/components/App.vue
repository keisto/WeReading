<template>
    <div class="flex flex-col flex-grow">
        <navigation></navigation>
        <div class="container flex-grow">
            <router-view class="min-h-full"></router-view>
        </div>
        <footer class="my-12 container text-gray-500">
            &copy; {{ new Date().getFullYear() }} WeReading by
            <a href="https://github.com/keisto" target="_blank" class="link">Tony Keiser</a>
        </footer>
    </div>
</template>
<script>
export default {
    //
}
</script>

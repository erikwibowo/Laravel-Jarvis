<script setup>
</script>
<template>
    <img
        :src="$page.props.app.setting.full_path_logo"
        :alt="'Logo ' + $page.props.app.setting.name"
    />
</template>

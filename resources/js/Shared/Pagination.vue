<template>
    <div>
        <nav aria-label="...">
            <ul class="pagination pagination-sm">
                <li class="page-item" v-for="link in links" :class="{ 'active': link.active, 'disabled': !link.url }">
                    <Component :is="link.url && !link.active ? 'Link' : 'span'" :href="link.url" class="page-link">
                        <template v-if="!link.active">
                            <div v-html="link.label"></div>
                        </template>
                        <template v-else>
                            <div v-html="link.label"></div>
                            <span class="sr-only">(current)</span>
                        </template>

                    </Component>
                </li>

            </ul>
        </nav>

        <!-- <Component :is="link.url ? 'Link' : 'span'" v-for="link in links" :href="link.url" v-html="link.label"
            class="px-1" :class="{ 'text-secondary': link.url, 'font-weight-bold': link.active }" /> -->

    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'

export default {
    
    components: {
        Link,
    },
    props: {
        links: Array,
    }
}
</script>
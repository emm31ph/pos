<template>
<div>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center mb-0">
            <li class="page-item" :class="hasFirst?'disabled':''"><a class="page-link" @click.prevent="first">First</a></li>
            <li class="page-item" :class="hasFirst?'disabled':''"><a class="page-link" @click.prevent="prev" >&lsaquo;</a></li>
            <li class="page-item" v-for="page in items" :key="page.label" :class="page.active ? 'active' : ''"> 
                <a v-if="page.disable" class="page-link">&hellip;</a> 
                <a v-else class="page-link" @click.prevent="goto(page.label)">{{ page.label }}</a>
            </li> 
            <li class="page-item" @click.prevent="next" :class="hasLast?'disabled':''"><a class="page-link" @click.prevent="next">&rsaquo;</a></li>
            <li class="page-item" @click.prevent="next" :class="hasLast?'disabled':''"><a class="page-link" @click.prevent="last">Last</a>
            </li>
        </ul> 
    </nav>
</div>
</template>

<script>
export default {
    props: {
        value: {
            // current page
            type: Number,
            required: true,
        },
        pageCount: {
            // page numbers
            type: Number,
            required: true,
        },
        classes: {
            type: Object,
            required: false,
            default: () => ({}),
        },
        labels: {
            type: Object,
            required: false,
            default: () => ({}),
        },
    },
    mounted() {
        if (this.value > this.pageCount) {
            this.$emit("input", this.pageCount);
        }
    },

    computed: {
        items() {
            let valPrev = this.value > 1 ? this.value - 1 : 1; // for easier navigation - gives one previous page
            let valNext =
                this.value < this.pageCount ? this.value + 1 : this.pageCount; // one next page
            let extraPrev = valPrev === 3 ? 2 : null;
            let extraNext =
                valNext === this.pageCount - 2 ? this.pageCount - 1 : null;
            let dotsBefore = valPrev > 3 ? 2 : null;
            let dotsAfter = valNext < this.pageCount - 2 ? this.pageCount - 1 : null;

            let output = [];

            for (let i = 1; i <= this.pageCount; i += 1) {
                if (
                    [
                        1,
                        this.pageCount,
                        this.value,
                        valPrev,
                        valNext,
                        extraPrev,
                        extraNext,
                        dotsBefore,
                        dotsAfter,
                    ].includes(i)
                ) {
                    output.push({
                        label: i,
                        active: this.value === i,
                        disable: [dotsBefore, dotsAfter].includes(i),
                    });
                }
            }

            return output;
        },

        hasFirst() {
            return this.value === 1;
        },

        hasLast() {
            return this.value === this.pageCount;
        },
    },

    watch: {
        value: function () {
            this.$emit("change");
        },
    },

    methods: {
        first() {
            if (!this.hasFirst) {
                this.$emit("input", 1);
            }
        },

        prev() {
            if (!this.hasFirst) {
                this.$emit("input", this.value - 1);
            }
        },

        goto(page) {
            this.$emit("input", page);
        },

        next() {
            if (!this.hasLast) {
                this.$emit("input", this.value + 1);
            }
        },

        last() {
            if (!this.hasLast) {
                this.$emit("input", this.pageCount);
            }
        },
    },
}
</script>

<style lang="scss" scoped>

</style>

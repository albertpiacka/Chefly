<template>
    <div>
        <div class="search" data-aos="fade-up" data-aos-delay="400">
            <input type="text" @keydown.enter="findTag" v-model="query" placeholder="Search for tag" class="shadow-lg">
            <b-button pill @click="findTag">Go</b-button>
            <b-button pill variant="warning" class="text-white" @click="resetTags">Reset</b-button>
        </div>
        <div class="tags">
            <div v-for="tag in maxTags(items, max)" :key="tag.id" data-aos="fade-up" :data-aos-delay="`${tag.id}00`">
                <b-button pill variant="primary" :href="`/tags/${tag.id}`">{{tag.tag}}</b-button>
            </div>

            <div class="controls">
                <b-icon scale="1.5" @click="addTwoToMax" icon="three-dots" data-aos="fade-up"></b-icon>
                <b-icon scale="1.5" @click="setBack" icon="arrow-bar-left" data-aos="fade-up"></b-icon>
                <b-icon scale="1.5" @click="addMax" icon="arrow-bar-right" data-aos="fade-up"></b-icon>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['tags'],

        data() {
            return {
                max: 2,
                items: '',
                query: '',
            }
        },

        mounted () {
            this.items = this.tags

            window.addEventListener('keydown', e => {
                if(e.key == 'Escape'){
                    this.query = ''
                    this.resetTags()
                }
            })
        },

        methods: {
            maxTags(arr, num) {
                return arr.slice(0, num)
            },

            addTwoToMax(){
                if(this.max >= this.tags.length){
                    return
                } else this.max+=2
            },

            addMax(){
                this.max = this.tags.length
            },

            setBack(){
                this.max = 2
            },

            findTag(){
                this.items = this.items.filter(t => {
                    return t.tag.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase().includes(this.query.toLowerCase())
                })
            },

            resetTags(){
                this.items = this.tags
            }
        },
    }
</script>

<style lang="scss" scoped>
    %flex {
        display: flex;
        flex-wrap: wrap;
        flex-direction: row;
        grid-gap: 1em;
        align-items: center;
    }

    .search {
        input {
            margin: 1em 0;
            padding: .5em;
            border-radius: 2em;
            outline: none;
            border: none;
            opacity: .1;
        }
    }

    .tags {
        @extend %flex;
        margin: 1em 0;

        .controls {
            @extend %flex;
        }

        .b-icon {
            cursor: pointer;
        }
    }
</style>
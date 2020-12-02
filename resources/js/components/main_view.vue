<template>
        <div>
        <button type="button" class="col-12 btn btn-success" v-on:click="test_req()">Отправить запрос</button>
        <button type="button" class="col-12 btn btn-success" v-on:click="get_groupsofgoods()">Получить группы</button>
        <button type="button" class="col-12 btn btn-success" v-on:click="get_good()">Получить good</button>

                <div class="col-md-8 col-12">
                        <div class="newpass col-sm-12 d-sm-flex ">
                                <div class="col-12 col-sm-6 newpass1" style ="margin-top:50px;">Время: </div>
                                <div class="col-12 col-sm-6 newpass2" style ="margin-top:10px;">
                                        <input class="input" type="text" name="timer" v-model="timer" >
                                </div>
                        </div>
                        <div class="col-12 settimeubmit d-flex justify-content-center" style ="margin-top:3px;">
                                <button  type="button" v-on:click="set_time()">Задать время</button>
                        </div>
                </div>
    </div>

</template>

<script>
    export default {
        data() {
            return {
               timer:'',

            }
        },
        mounted() {

        },
        created() {
        },
        methods: {

            test_req()
            {
                axios
                    .post('/save_posts_admin',{
                        posts:this.posts

                    }).then(({ data }) =>
                {
                    if (data.status == 'success')
                    {
                        this.render_start_array();
                    }
                })
            },
            get_good()
            {
                axios
                    .post('/get_good',{
                        posts:this.posts

                    }).then(({ data }) =>
                {
                    if (data.status == 'success')
                    {
                        this.render_start_array();
                    }
                })
            },
            get_groupsofgoods()
            {
                axios
                    .post('/get_groupsofgoods',{
                        posts:this.posts

                    }).then(({ data }) =>
                {
                    if (data.status == 'success')
                    {
                        this.render_start_array();
                    }
                })
            },
        set_time()
        {
                axios
                        .post('/set_time',{
                                timer:this.timer

                        }).then(({ data }) =>
                {
                        console.log(data);
                })
        },

        }
    }

</script>

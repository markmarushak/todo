<template>
    
    <div class="table-responsive">
        <table class="table align-items-center">
            <thead class="thead-light">
            <tr>
                <th scope="col">Task</th>
                <th scope="col">trophy</th>
                <th scope="col">Status</th>
                <th scope="col">Dedline</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="task in tasks">
                <th scope="row">
                    <div class="media align-items-center">
                        <div class="media-body">
                            <span class="mb-0 text-sm">{{ task.task }}</span>
                        </div>
                    </div>
                </th>
                <td>
                    {{ task.trophy }}
                </td>
                <td>
                <span class="badge badge-dot mr-4">
                  <i class="bg-warning"></i> {{ task.status }}
              </span>
                </td>
                <td>
                    {{ task.dedline }}
                </td>
                <td class="text-right">
                    <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a class="dropdown-item" href="#">посмотреть план</a>
                            <a class="dropdown-item" href="#">ответить на идею</a>
                            <a class="dropdown-item" href="#">присоедениться</a>
                        </div>
                    </div>
                </td>
            </tr>

            </tbody>
        </table>

    </div>

</template>

<script>
    import axios from 'axios';

    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    export default {
        mounted() {
            console.log('Component mounted.');  
        },
        data: () => ({
            tasks: [],
            head: ['position', 'task', 'date']
        }),
        created(){
             axios.get('/task/show', {data: {_token: CSRF_TOKEN}})
            .then(response => {
                this.tasks = response.data;
                console.log(this.tasks);
            });
        }
    }
</script>

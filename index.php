<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Добавление Excel в бд</title>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/bootstrap-custom.css">
        <link rel="stylesheet" href="css/style.css">
        <script src="https://unpkg.com/vue@2"></script>
        <script src="https://unpkg.com/jquery@3.1.1/dist/jquery.js"></script>
	</head>
	<body>    

	<div id="app">
        <div class="container">
            <div class="row">
                <div class="span3 hidden-phone"></div>
                <div class="span6" id="form-login">
                    <div class="form-horizontal well">
                    <form class="" action="import.php" method="post" name="upload_excel" enctype="multipart/form-data">
                        <fieldset>
                            <legend>Добавьте Excel файл или выгрузить json</legend>
                            <div class="control-group">
                                    <input type="file" name="file" id="file" class="input-large">
                                    <button type="submit" id="submit" name="Import" class="btn btn-primary button-loading" >Загрузить</button>

                            </div>
                        </fieldset>
                    </form>
                    <button type="submit"  class="btn btn-primary button-loading" v-if="consultant.length" @click="donwloadJson" >Скачать Json</button>
                    </div>
                </div>
                <div class="span3 hidden-phone"></div>
            </div>

            <div >
                <table class="table table-bordered" v-if="consultant.length">
                    <thead>
                            <tr>
                                <th>ID</th>
                                <th>Консультант</th>
                                <th>Кол-во задач</th>
                                <th>Дивизион</th>
                                <th>Направление</th>
                                <th>Служба</th>
                                <th>Подразделение</th>
                            </tr>
                      </thead>

                            <tr  v-for="item of consultant">
                                <td>{{item.id }}</td>
                                <td>{{item.consultant }}</td>
                                <td>{{item.numberOfTasks }}</td>
                                <td>{{item.division }}</td>
                                <td>{{item.direction }}</td>
                                <td>{{item.service }}</td>
                                <td>{{item.subdivision }}</td>
                            </tr>
                </table>
                <div class="text" v-else>
                    <p>В таблтце нет данных</p>
                </div>
            </div>
        </div>
	</div>

	</body>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>




    <script>
        var app = new Vue({
            el: "#app",

            data: {
                consultant: [],
                isLoad: false,
                date: 'Json',

            },

            methods: {
                async donwloadJson() {
                    const response = await axios.get('https://projecttemplates/api/consultants/get_consultant_in_json')

                    if (response.data) {
                        const url = window.URL.createObjectURL(new Blob([response.data]))
                        const link = document.createElement('a')
                        link.href = url
                        link.setAttribute('download', `report-${this.date}.json`)
                        document.body.appendChild(link)
                        link.click()
                    }

                },
                async getConsultant(){
                    let result = []
                    await axios.get('https://projecttemplates/api/consultants/app')
                        .then(function (response) {
                            if (response.data){
                                for (let value of response.data) {
                                    result.push(value)
                                }
                            }else {
                                console.log(response.data.message)
                            }
                        });
                    this.consultant = result
                    return result
            },
            },
            async mounted() {
                this.getConsultant()
            }
        });

    </script>
</html>
<!--  Script Referentiel Metiers  -->
<script>
    const vue = new Vue({
        data: {
            errorMsg: false,
            successMsg: false,
            showAddModal: false,
            showUpdateModal: false,
            showDeleteModal: false,
            urlGET: "API/api_pgav.php?action=getCorps",
            urlGETClasses: "API/api_pgav.php?action=getCclasses",
            // urlGETSecteurs: "API/api_pgav.php?action=getSecteurs",
            urlPOST: "API/api_pgav.php?action=postCorps",
            urlUPDATE: "API/api_pgav.php?action=updateCorps",
            urlDELETE: "API/api_pgav.php?action=deleteCorps",
            corps: [],
            classes:[],
            // secteurs:[],
            newCorps: {},
            currentCorps: {}
        },
        computed: {
            
        },
        mounted() {
            this.getAllCorps();
            this.getAllClasses();
            // this.getAllSecteurs();

        },
        methods: {
            getAllCorps() {
                axios.get(this.urlGET)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.corps = resultat.corps;

                        }

                    })
            },

            getAllClasses() {
                axios.get(this.urlGETClasses)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.classes = resultat.classes;

                        }

                    })
            },
         
          
            addCorps() {

                // On prepare le form pour insertion les champs dans le variable global POST
                var formData = this.toFormData(this.newCorps);

                //On lance la requete POST (Create)
                axios.post(this.urlPOST, formData)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        this.newCorps = {
                        }
                        if (resultat.error) {
                            this.errorMsg = resultat.error;
                        } else {
                            this.hideMsg();
                            this.successMsg = resultat.message;
                            this.getAllCorps();
                        }
                    })


            },
            updateCorps() {
                // On prepare le form pour insertion les champs dans le variable global POST
                var formData = this.toFormData(this.currentCorps);

                //On lance la requete GET (Create)
                axios.post(this.urlUPDATE, formData)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        this.currentCorps = {};
                        if (resultat.error) {
                            this.errorMsg = resultat.error;
                        } else {
                            this.successMsg = resultat.message;
                            this.getAllCorps();
                        }
                    })


            },

            deleteCorps() {
                // On prepare le form pour insertion les champs dans le variable global POST
                var formData = this.toFormData(this.currentCorps);

                //On lance la requete GET (Create)
                axios.post(this.urlDELETE, formData)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        this.currentCorps = {};
                        if (resultat.error) {
                            this.errorMsg = resultat.message
                        } else {
                            this.successMsg = resultat.message;
                            this.getAllCorps();
                        }
                    })


            },

            hideMsg() {
                this.errorMsg = false,
                    this.successMsg = false
            },

            toFormData(obj) {
                var fd = new FormData();
                for (var i in obj) {
                    fd.append(i, obj[i]);
                }

                return fd;
            },
            // Methode pour recuperer le periodes selectionné 
            selectedCorps(corps) {
                this.currentCorps = corps;
            }


        }


    }).$mount('#app')
</script>
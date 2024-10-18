<!--  Script Referentiel Directions Generales  -->
<script>
    const vue = new Vue({
        data: {
            errorMsg: false,
            successMsg: false,
            showAddModal: false,
            showUpdateModal: false,
            showDeleteModal: false,
            urlGET: "API/api_pgav.php?action=getAgences",
            urlGETBanques: "API/api_pgav.php?action=getBanques",
            urlPOST: "API/api_pgav.php?action=postAgence",
            urlUPDATE: "API/api_pgav.php?action=updateAgence",
            urlDELETE: "API/api_pgav.php?action=deleteAgence",
            agences: [],
            banques: [],
            newAgence: {},
            currentAgence: {}
        },
        computed: {
            
        },
        mounted() {
            this.getAllAgences();
            this.getAllBanques();

        },
        methods: {
            getAllAgences() {
                axios.get(this.urlGET)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.agences = resultat.agences;

                        }

                    })
            },
            getAllBanques() {
                axios.get(this.urlGETBanques)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.banques = resultat.banques;

                        }

                    })
            },
          
            addAgence() {

                // On prepare le form pour insertion les champs dans le variable global POST
                var formData = this.toFormData(this.newAgence);

                //On lance la requete GET (Create)
                axios.post(this.urlPOST, formData)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        this.newAgence = {
                        }
                        if (resultat.error) {
                            this.errorMsg = resultat.error;
                        } else {
                            this.hideMsg();
                            this.successMsg = resultat.message;
                            this.getAllAgences();
                        }
                    })


            },
            updateAgence() {
                // On prepare le form pour insertion les champs dans le variable global POST
                var formData = this.toFormData(this.currentAgence);

                //On lance la requete GET (Create)
                axios.post(this.urlUPDATE, formData)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        this.currentAgence = {};
                        if (resultat.error) {
                            this.errorMsg = resultat.error;
                        } else {
                            this.successMsg = resultat.message;
                            this.getAllAgences();
                        }
                    })


            },

            deleteAgence() {
                // On prepare le form pour insertion les champs dans le variable global POST
                var formData = this.toFormData(this.currentAgence);

                //On lance la requete GET (Create)
                axios.post(this.urlDELETE, formData)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        this.currentAgence = {};
                        if (resultat.error) {
                            this.errorMsg = resultat.message
                        } else {
                            this.successMsg = resultat.message;
                            this.getAllAgences();
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
            selectedAgence(Agence) {
                this.currentAgence = Agence;
            }


        }


    }).$mount('#app')
</script>
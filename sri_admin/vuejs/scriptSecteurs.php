<!--  Script Referentiel Secteurs  -->
<script>
    const vue = new Vue({
        data: {
            errorMsg: false,
            successMsg: false,
            showAddModal: false,
            showUpdateModal: false,
            showDeleteModal: false,
            urlGET: "API/api_pgav.php?action=getSecteurs",
            urlPOST: "API/api_pgav.php?action=postSecteur",
            urlUPDATE: "API/api_pgav.php?action=updateSecteur",
            urlDELETE: "API/api_pgav.php?action=deleteSecteur",
            secteurs: [],
            newSecteur: {},
            currentSecteur: {}
        },
        computed: {
            
        },
        mounted() {
            this.getAllSecteurs();

        },
        methods: {
            getAllSecteurs() {
                axios.get(this.urlGET)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.secteurs = resultat.secteurs;

                        }

                    })
            },
          
            addSecteur() {

                // On prepare le form pour insertion les champs dans le variable global POST
                var formData = this.toFormData(this.newSecteur);

                //On lance la requete GET (Create)
                axios.post(this.urlPOST, formData)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        this.newSecteur = {
                        }
                        if (resultat.error) {
                            this.errorMsg = resultat.error;
                        } else {
                            this.hideMsg();
                            this.successMsg = resultat.message;
                            this.getAllSecteurs();
                        }
                    })


            },
            updateSecteur() {
                // On prepare le form pour insertion les champs dans le variable global POST
                var formData = this.toFormData(this.currentSecteur);

                //On lance la requete GET (Create)
                axios.post(this.urlUPDATE, formData)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        this.currentSecteur = {};
                        if (resultat.error) {
                            this.errorMsg = resultat.error;
                        } else {
                            this.successMsg = resultat.message;
                            this.getAllSecteurs();
                        }
                    })


            },

            deleteSecteur() {
                // On prepare le form pour insertion les champs dans le variable global POST
                var formData = this.toFormData(this.currentSecteur);

                //On lance la requete GET (Create)
                axios.post(this.urlDELETE, formData)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        this.currentSecteur = {};
                        if (resultat.error) {
                            this.errorMsg = resultat.message
                        } else {
                            this.successMsg = resultat.message;
                            this.getAllSecteurs();
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
            selectedSecteur(Secteur) {
                this.currentSecteur = Secteur;
            }


        }


    }).$mount('#app')
</script>
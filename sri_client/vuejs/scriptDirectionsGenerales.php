<!--  Script Referentiel Directions Generales  -->
<script>
    const vue = new Vue({
        data: {
            errorMsg: false,
            successMsg: false,
            showAddModal: false,
            showUpdateModal: false,
            showDeleteModal: false,
            urlGET: "API/api_pgav.php?action=getDirectionsGenerales",
            urlGETMinisteres: "API/api_pgav.php?action=getMinistere",
            urlPOST: "API/api_pgav.php?action=postDirectionGenerale",
            urlUPDATE: "API/api_pgav.php?action=updateDirectionGenerale",
            urlDELETE: "API/api_pgav.php?action=deleteDirectionGenerale",
            directionsGenerales: [],
            ministeres: [],
            newDirectionGenerale: {},
            currentDirectionGenerale: {}
        },
        computed: {
            
        },
        mounted() {
            this.getAllDirectionsGenerales();
            this.getAllMinisteres();

        },
        methods: {
            getAllDirectionsGenerales() {
                axios.get(this.urlGET)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.directionsGenerales = resultat.directionsGenerales;

                        }

                    })
            },
            getAllMinisteres() {
                axios.get(this.urlGETMinisteres)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.ministeres = resultat.ministeres;

                        }

                    })
            },
          
            addDirectionGenerale() {

                // On prepare le form pour insertion les champs dans le variable global POST
                var formData = this.toFormData(this.newDirectionGenerale);

                //On lance la requete GET (Create)
                axios.post(this.urlPOST, formData)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        this.newDirectionGenerale = {
                        }
                        if (resultat.error) {
                            this.errorMsg = resultat.error;
                        } else {
                            this.hideMsg();
                            this.successMsg = resultat.message;
                            this.getAllDirectionsGenerales();
                        }
                    })


            },
            updateDirectionGenerale() {
                // On prepare le form pour insertion les champs dans le variable global POST
                var formData = this.toFormData(this.currentDirectionGenerale);

                //On lance la requete GET (Create)
                axios.post(this.urlUPDATE, formData)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        this.currentDirectionGenerale = {};
                        if (resultat.error) {
                            this.errorMsg = resultat.error;
                        } else {
                            this.successMsg = resultat.message;
                            this.getAllDirectionsGenerales();
                        }
                    })


            },

            deleteDirectionGenerale() {
                // On prepare le form pour insertion les champs dans le variable global POST
                var formData = this.toFormData(this.currentDirectionGenerale);

                //On lance la requete GET (Create)
                axios.post(this.urlDELETE, formData)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        this.currentDirectionGenerale = {};
                        if (resultat.error) {
                            this.errorMsg = resultat.message
                        } else {
                            this.successMsg = resultat.message;
                            this.getAllDirectionsGenerales();
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
            selectedDirectionGenerale(directionGenerale) {
                this.currentDirectionGenerale = directionGenerale;
            }


        }


    }).$mount('#app')
</script>
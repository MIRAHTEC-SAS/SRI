<!--  Script Referentiel Directions s  -->
<script>
    const vue = new Vue({
        data: {
            errorMsg: false,
            successMsg: false,
            showAddModal: false,
            showUpdateModal: false,
            showDeleteModal: false,
            urlGETDirections: "API/api_pgav.php?action=getDirections",
            urlGETMinisteres: "API/api_pgav.php?action=getMinistere",
            urlGETDirectionsGenerales: "API/api_pgav.php?action=getDirectionsGenerales",
            urlPOST: "API/api_pgav.php?action=postDirection",
            urlUPDATE: "API/api_pgav.php?action=updateDirection",
            urlDELETE: "API/api_pgav.php?action=deleteDirection",
            directions: [],
            directionsGenerales: [], 
            ministeres: [],
            newDirection: {},
            currentDirection: {}
        },
        computed: {
            
        },
        mounted() {
            this.getAllDirections();
            this.getAllMinisteres();
            this.getAllDirectionsGenerales();

        },
        methods: {
            getAllDirections() {
                axios.get(this.urlGETDirections)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.directions = resultat.directions;

                        }

                    })
            },
            getAllDirectionsGenerales() {
                axios.get(this.urlGETDirectionsGenerales)
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
          
            addDirection() {

                // On prepare le form pour insertion les champs dans le variable global POST
                var formData = this.toFormData(this.newDirection);

                //On lance la requete GET (Create)
                axios.post(this.urlPOST, formData)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        this.newDirection = {
                        }
                        if (resultat.error) {
                            this.errorMsg = resultat.error;
                        } else {
                            this.hideMsg();
                            this.successMsg = resultat.message;
                            this.getAllDirections();
                        }
                    })


            },
            updateDirection() {
                // On prepare le form pour insertion les champs dans le variable global POST
                var formData = this.toFormData(this.currentDirection);

                //On lance la requete GET (Create)
                axios.post(this.urlUPDATE, formData)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        this.currentDirection = {};
                        if (resultat.error) {
                            this.errorMsg = resultat.error;
                        } else {
                            this.successMsg = resultat.message;
                            this.getAllDirections();
                        }
                    })


            },

            deleteDirection() {
                // On prepare le form pour insertion les champs dans le variable global POST
                var formData = this.toFormData(this.currentDirection);

                //On lance la requete GET (Create)
                axios.post(this.urlDELETE, formData)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        this.currentDirection = {};
                        if (resultat.error) {
                            this.errorMsg = resultat.message
                        } else {
                            this.successMsg = resultat.message;
                            this.getAllDirections();
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
            selectedDirection(direction) {
                this.currentDirection = direction;
            }


        }


    }).$mount('#app')
</script>
<!--  Script Referentiel Ministeres  -->
<script>
    const vue = new Vue({
        data: {
            errorMsg: false,
            successMsg: false,
            showAddModal: false,
            showUpdateModal: false,
            showDeleteModal: false,
            urlGET: "API/api_pgav.php?action=getMinistere",
            urlPOST: "API/api_pgav.php?action=postMinistere",
            urlUPDATE: "API/api_pgav.php?action=updateMinistere",
            urlDELETE: "API/api_pgav.php?action=deleteMinistere",
            ministeres: [],
            newMinistere: {},
            currentMinistere: {}
        },
        computed: {
            
        },
        mounted() {
            this.getAllMinisteres();

        },
        methods: {
            getAllMinisteres() {
                axios.get(this.urlGET)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.ministeres = resultat.ministeres;

                        }

                    })
            },
          
            addMinistere() {

                // On prepare le form pour insertion les champs dans le variable global POST
                var formData = this.toFormData(this.newMinistere);

                //On lance la requete GET (Create)
                axios.post(this.urlPOST, formData)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        this.newMinistere = {
                        }
                        if (resultat.error) {
                            this.errorMsg = resultat.error;
                        } else {
                            this.hideMsg();
                            this.successMsg = resultat.message;
                            this.getAllMinisteres();
                        }
                    })


            },
            updateMinistere() {
                // On prepare le form pour insertion les champs dans le variable global POST
                var formData = this.toFormData(this.currentMinistere);

                //On lance la requete GET (Create)
                axios.post(this.urlUPDATE, formData)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        this.currentMinistere = {};
                        if (resultat.error) {
                            this.errorMsg = resultat.error;
                        } else {
                            this.successMsg = resultat.message;
                            this.getAllMinisteres();
                        }
                    })


            },

            deleteMinistere() {
                // On prepare le form pour insertion les champs dans le variable global POST
                var formData = this.toFormData(this.currentMinistere);

                //On lance la requete GET (Create)
                axios.post(this.urlDELETE, formData)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        this.currentMinistere = {};
                        if (resultat.error) {
                            this.errorMsg = resultat.message
                        } else {
                            this.successMsg = resultat.message;
                            this.getAllMinisteres();
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
            selectedMinistere(ministere) {
                this.currentMinistere = ministere;
            }


        }


    }).$mount('#app')
</script>
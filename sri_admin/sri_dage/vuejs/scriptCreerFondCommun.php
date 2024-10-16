<!--  Script Referentiel Hierarchies  -->
<script>
    const vue = new Vue({
        data: {
            errorMsg: false,
            successMsg: false,
            showAddModal: false,
            showUpdateModal: false,
            showDeleteModal: false,
            urlGET: "API/api_pgav.php?action=getHierarchies",
            urlPOST: "API/api_pgav.php?action=postHierarchie",
            urlUPDATE: "API/api_pgav.php?action=updateHierarchie",
            urlDELETE: "API/api_pgav.php?action=deleteHierarchie",
            hierarchies: [],
            newHierarchie: {},
            currentHierarchie: {}
        },
        computed: {
            
        },
        mounted() {
            this.getAllHierarchies();

        },
        methods: {
            getAllHierarchies() {
                axios.get(this.urlGET)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.hierarchies = resultat.hierarchies;

                        }

                    })
            },
          
            addHierarchie() {

                // On prepare le form pour insertion les champs dans le variable global POST
                var formData = this.toFormData(this.newHierarchie);

                //On lance la requete GET (Create)
                axios.post(this.urlPOST, formData)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        this.newHierarchie = {
                        }
                        if (resultat.error) {
                            this.errorMsg = resultat.error;
                        } else {
                            this.hideMsg();
                            this.successMsg = resultat.message;
                            this.getAllHierarchies();
                        }
                    })


            },
            updateHierarchie() {
                // On prepare le form pour insertion les champs dans le variable global POST
                var formData = this.toFormData(this.currentHierarchie);

                //On lance la requete GET (Create)
                axios.post(this.urlUPDATE, formData)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        this.currentHierarchie = {};
                        if (resultat.error) {
                            this.errorMsg = resultat.error;
                        } else {
                            this.successMsg = resultat.message;
                            this.getAllHierarchies();
                        }
                    })


            },

            deleteHierarchie() {
                // On prepare le form pour insertion les champs dans le variable global POST
                var formData = this.toFormData(this.currentHierarchie);

                //On lance la requete GET (Create)
                axios.post(this.urlDELETE, formData)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        this.currentHierarchie = {};
                        if (resultat.error) {
                            this.errorMsg = resultat.message
                        } else {
                            this.successMsg = resultat.message;
                            this.getAllHierarchies();
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
            selectedHierarchie(hierarchie) {
                this.currentHierarchie = hierarchie;
            }


        }


    }).$mount('#app')
</script>
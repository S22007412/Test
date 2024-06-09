
                        // JavaScript to toggle visibility of file upload form
                        document.getElementById('modifyButton').addEventListener('click', function() {
                            var form = document.querySelector('.modify-form');
                            if (form.style.display === 'none' || form.style.display === '') {
                                form.style.display = 'block';                
                                // document.querySelector('.modify-container').style.marginTop = '-8vh'; // Adjust the value as needed
                                //document.querySelector('.modify-container').style.height = '12vh'; // Reset to the original value
                                //document.querySelector('.edificio-img').style.marginBottom = '-4vh'; // Adjust the value as needed
                            } else {
                                form.style.display = 'none';
                                //document.querySelector('.modify-container').style.marginTop = '-8vh'; // Adjust the value as needed
                                // document.querySelector('.modify-container').style.height = '3vh'; // Reset to the original value
                                //document.querySelector('.edificio-img').style.marginBottom = '-4vh';
                            }
                        });

                        
                        // JavaScript to toggle visibility of file upload form
                        document.getElementById('modifyButton2').addEventListener('click', function() {
                            var form = document.querySelector('.modify-form2');
                            if (form.style.display === 'none' || form.style.display === '') {
                                form.style.display = 'block'; 
                            } else {
                                form.style.display = 'none';
                            }
                        });

                        
                        // JavaScript to toggle visibility of file upload form
                        document.getElementById('modifyButton3').addEventListener('click', function() {
                            var form = document.querySelector('.modify-form3');
                            if (form.style.display === 'none' || form.style.display === '') {
                                form.style.display = 'block'; 
                            } else {
                                form.style.display = 'none';
                            }
                        });
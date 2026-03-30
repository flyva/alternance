document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactForm');
    const messageDiv = document.getElementById('formMessage');

    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            // Désactiver le bouton pendant l'envoi
            const submitButton = form.querySelector('button[type="submit"]');
            submitButton.disabled = true;

            // Collecter les données du formulaire
            const formData = new FormData(form);

            // Envoyer la requête AJAX
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest' // Pour détecter une requête AJAX côté PHP
                }
            })
                .then(response => {
                    // Essayer de lire le JSON, sinon produire une erreur lisible
                    return response.text().then(text => {
                        try {
                            return { ok: response.ok, json: JSON.parse(text) };
                        } catch (err) {
                            return { ok: response.ok, text: text };
                        }
                    });
                })
                .then(result => {
                    messageDiv.style.display = 'block';
                    // Si le serveur a renvoyé un JSON
                    if (result.json) {
                        const data = result.json;
                        if (data.success) {
                            messageDiv.className = 'alert alert-success mt-4';
                            messageDiv.textContent = data.message || 'Votre message a été envoyé avec succès !';

                            // Si une redirection est indiquée
                            if (data.redirect) {
                                setTimeout(function() {
                                    window.location.href = data.redirect;
                                }, 2000); // Redirection après 2 secondes pour laisser l'utilisateur lire le message
                            }

                            form.reset();
                        } else {
                            messageDiv.className = 'alert alert-danger mt-4';
                            // Afficher le message renvoyé par le serveur si présent
                            messageDiv.textContent = data.message || 'Une erreur est survenue lors de l\'envoi du message. Veuillez réessayer.';
                            if (data.debug) {
                                const pre = document.createElement('pre');
                                pre.style.maxHeight = '200px';
                                pre.style.overflow = 'auto';
                                pre.textContent = data.debug;
                                messageDiv.appendChild(pre);
                            }
                        }
                    } else {
                        // Réponse non-JSON
                        messageDiv.className = 'alert alert-danger mt-4';
                        messageDiv.textContent = result.text || 'Une erreur est survenue lors de l\'envoi du message. Veuillez réessayer.';
                    }
                })
                .catch(error => {
                    messageDiv.style.display = 'block';
                    messageDiv.className = 'alert alert-danger mt-4';
                    messageDiv.textContent = 'Une erreur est survenue lors de l\'envoi du message. Veuillez réessayer.';
                    // Afficher l'erreur JS pour debug local
                    const pre = document.createElement('pre');
                    pre.style.maxHeight = '200px';
                    pre.style.overflow = 'auto';
                    pre.textContent = error.toString();
                    messageDiv.appendChild(pre);
                })
                .finally(() => {
                    submitButton.disabled = false;
                });
        });
    }
});
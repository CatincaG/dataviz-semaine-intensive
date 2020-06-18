class Country
{
    constructor()
    {
        // Get elements of the DOM
        this.domainsButton = document.querySelectorAll('a')

        this.studiesDomain = document.querySelector('.studies-content')
        this.workDomain = document.querySelector('.work-content')
        this.powerDomain = document.querySelector('.power-content')
        this.healthDomain = document.querySelector('.health-content')
        this.violenceDomain = document.querySelector('.violence-content')

        // Set functions
        this.setCurrentClassToButton()
        //this.displayDataAccordingToDomain()
    }

    setCurrentClassToButton()
    {
        this.domainsButton.forEach(_button =>
        {
            _button.addEventListener('click', () => 
            {
                // Change the state of the current button
                const initialButton = document.querySelector('a.js-current-button')
                initialButton.classList.remove('js-current-button')

                // Change the state of the button clicked by the user
                _button.classList.add('js-current-button')

                if(_button.classList.contains('studies-button') && this.studiesDomain.classList.contains('js-hidden'))
                {
                    this.studiesDomain.classList.remove('js-hidden')
                    this.workDomain.classList.add('js-hidden')
                    this.violenceDomain.classList.add('js-hidden')
                    this.powerDomain.classList.add('js-hidden')
                    this.healthDomain.classList.add('js-hidden')
                } 
                else if(_button.classList.contains('work-button') && this.workDomain.classList.contains('js-hidden'))
                {
                    this.workDomain.classList.remove('js-hidden')
                    this.studiesDomain.classList.add('js-hidden')
                    this.violenceDomain.classList.add('js-hidden')
                    this.powerDomain.classList.add('js-hidden')
                    this.healthDomain.classList.add('js-hidden')
                } 
                else if(_button.classList.contains('power-button') && this.powerDomain.classList.contains('js-hidden'))
                {
                    this.powerDomain.classList.remove('js-hidden')
                    this.studiesDomain.classList.add('js-hidden')
                    this.violenceDomain.classList.add('js-hidden')
                    this.workDomain.classList.add('js-hidden')
                    this.healthDomain.classList.add('js-hidden')
                }
                else if(_button.classList.contains('health-button') && this.healthDomain.classList.contains('js-hidden'))
                {
                    this.healthDomain.classList.remove('js-hidden')
                    this.studiesDomain.classList.add('js-hidden')
                    this.violenceDomain.classList.add('js-hidden')
                    this.workDomain.classList.add('js-hidden')
                    this.powerDomain.classList.add('js-hidden')
                }
                else if(_button.classList.contains('violence-button') && this.violenceDomain.classList.contains('js-hidden'))
                {
                    this.violenceDomain.classList.remove('js-hidden')
                    this.studiesDomain.classList.add('js-hidden')
                    this.healthDomain.classList.add('js-hidden')
                    this.workDomain.classList.add('js-hidden')
                    this.powerDomain.classList.add('js-hidden')
                }
            })
        })
    }
}

const country = new Country()
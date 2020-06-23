class Country
{
    constructor()
    {
        // Get the 5 categories
        this.domainsButton = document.querySelectorAll('a')
        this.studiesDomain = document.querySelector('.studies-content')
        this.workDomain = document.querySelector('.work-content')
        this.powerDomain = document.querySelector('.power-content')
        this.healthDomain = document.querySelector('.health-content')
        this.violenceDomain = document.querySelector('.violence-content')

        // Get illustrations for each category
        this.studiesIllustration = document.querySelector('div.container-studies-illustration')
        this.workIllustration = document.querySelector('img.work-illustration')
        this.violenceIllustration = document.querySelector('img.violence-illustration')
        this.powerIllustration = document.querySelector('img.power-illustration')
        this.healthIllustration = document.querySelector('img.health-illustration')

        // Get the chart for each category
        this.chartStudies = document.querySelector('div.js-chart-studies')
        this.chartWork = document.querySelector('div.js-chart-work')
        this.chartPower = document.querySelector('div.js-chart-power')
        this.chartHealth = document.querySelector('div.js-chart-health')
        this.chartViolence = document.querySelector('div.js-chart-violence')

        // Get sources for each category
        this.sourceStudies = document.querySelector('p.source-studies')
        this.sourceWork = document.querySelector('p.source-work')
        this.sourceHealth = document.querySelector('p.source-health')
        this.sourcePower = document.querySelector('p.source-power')

        // Get background URL
        this.backgroundImagePath = "../../assets/svg/background/"

        // Set functions
        this.setCurrentCategory()
        this.changeBackgroundColor()
    }

    setCurrentCategory()
    {
        this.domainsButton.forEach(_button =>
        {
            _button.addEventListener('click', () => 
            {
                /** Set current button */
                // Change the state of the current button
                const initialButton = document.querySelector('a.js-current-button')
                initialButton.classList.remove('js-current-button')

                // Change the state of the button clicked by the user
                _button.classList.add('js-current-button')

                /** Display right elements according to the category selected */
                if(_button.classList.contains('studies-button') && this.studiesDomain.classList.contains('js-hidden'))
                {
                    this.studiesDomain.classList.remove('js-hidden')
                    this.workDomain.classList.add('js-hidden')
                    this.violenceDomain.classList.add('js-hidden')
                    this.powerDomain.classList.add('js-hidden')
                    this.healthDomain.classList.add('js-hidden')

                    this.studiesIllustration.classList.remove('js-hidden')
                    this.workIllustration.classList.add('js-hidden')
                    this.violenceIllustration.classList.add('js-hidden')
                    this.powerIllustration.classList.add('js-hidden')
                    this.healthIllustration.classList.add('js-hidden')

                    this.chartStudies.classList.remove('js-hidden')
                    this.chartWork.classList.add('js-hidden')
                    this.chartPower.classList.add('js-hidden')
                    this.chartHealth.classList.add('js-hidden')
                    this.chartViolence.classList.add('js-hidden')

                    this.sourceStudies.classList.remove('js-hidden')
                    this.sourceWork.classList.add('js-hidden')
                    this.sourceHealth.classList.add('js-hidden')
                    this.sourcePower.classList.add('js-hidden')
                } 
                else if(_button.classList.contains('work-button') && this.workDomain.classList.contains('js-hidden'))
                {
                    this.workDomain.classList.remove('js-hidden')
                    this.studiesDomain.classList.add('js-hidden')
                    this.violenceDomain.classList.add('js-hidden')
                    this.powerDomain.classList.add('js-hidden')
                    this.healthDomain.classList.add('js-hidden')

                    this.studiesIllustration.classList.add('js-hidden')
                    this.workIllustration.classList.remove('js-hidden')
                    this.violenceIllustration.classList.add('js-hidden')
                    this.powerIllustration.classList.add('js-hidden')
                    this.healthIllustration.classList.add('js-hidden')

                    this.chartStudies.classList.add('js-hidden')
                    this.chartWork.classList.remove('js-hidden')
                    this.chartPower.classList.add('js-hidden')
                    this.chartHealth.classList.add('js-hidden')
                    this.chartViolence.classList.add('js-hidden')

                    this.sourceStudies.classList.add('js-hidden')
                    this.sourceWork.classList.remove('js-hidden')
                    this.sourceHealth.classList.add('js-hidden')
                    this.sourcePower.classList.add('js-hidden')
                } 
                else if(_button.classList.contains('power-button') && this.powerDomain.classList.contains('js-hidden'))
                {
                    this.powerDomain.classList.remove('js-hidden')
                    this.studiesDomain.classList.add('js-hidden')
                    this.violenceDomain.classList.add('js-hidden')
                    this.workDomain.classList.add('js-hidden')
                    this.healthDomain.classList.add('js-hidden')

                    this.studiesIllustration.classList.add('js-hidden')
                    this.workIllustration.classList.add('js-hidden')
                    this.violenceIllustration.classList.add('js-hidden')
                    this.powerIllustration.classList.remove('js-hidden')
                    this.healthIllustration.classList.add('js-hidden')

                    this.chartStudies.classList.add('js-hidden')
                    this.chartWork.classList.add('js-hidden')
                    this.chartPower.classList.remove('js-hidden')
                    this.chartHealth.classList.add('js-hidden')
                    this.chartViolence.classList.add('js-hidden')

                    this.sourceStudies.classList.add('js-hidden')
                    this.sourceWork.classList.add('js-hidden')
                    this.sourceHealth.classList.add('js-hidden')
                    this.sourcePower.classList.remove('js-hidden')
                }
                else if(_button.classList.contains('health-button') && this.healthDomain.classList.contains('js-hidden'))
                {
                    this.healthDomain.classList.remove('js-hidden')
                    this.studiesDomain.classList.add('js-hidden')
                    this.violenceDomain.classList.add('js-hidden')
                    this.workDomain.classList.add('js-hidden')
                    this.powerDomain.classList.add('js-hidden')

                    this.studiesIllustration.classList.add('js-hidden')
                    this.workIllustration.classList.add('js-hidden')
                    this.violenceIllustration.classList.add('js-hidden')
                    this.powerIllustration.classList.add('js-hidden')
                    this.healthIllustration.classList.remove('js-hidden')

                    this.chartStudies.classList.add('js-hidden')
                    this.chartWork.classList.add('js-hidden')
                    this.chartPower.classList.add('js-hidden')
                    this.chartHealth.classList.remove('js-hidden')
                    this.chartViolence.classList.add('js-hidden')

                    this.sourceStudies.classList.add('js-hidden')
                    this.sourceWork.classList.add('js-hidden')
                    this.sourceHealth.classList.remove('js-hidden')
                    this.sourcePower.classList.add('js-hidden')
                }
                else if(_button.classList.contains('violence-button') && this.violenceDomain.classList.contains('js-hidden'))
                {
                    this.violenceDomain.classList.remove('js-hidden')
                    this.studiesDomain.classList.add('js-hidden')
                    this.healthDomain.classList.add('js-hidden')
                    this.workDomain.classList.add('js-hidden')
                    this.powerDomain.classList.add('js-hidden')

                    this.studiesIllustration.classList.add('js-hidden')
                    this.workIllustration.classList.add('js-hidden')
                    this.violenceIllustration.classList.remove('js-hidden')
                    this.powerIllustration.classList.add('js-hidden')
                    this.healthIllustration.classList.add('js-hidden')
                    
                    this.chartStudies.classList.add('js-hidden')
                    this.chartWork.classList.add('js-hidden')
                    this.chartPower.classList.add('js-hidden')
                    this.chartHealth.classList.add('js-hidden')
                    this.chartViolence.classList.remove('js-hidden')

                    this.sourceStudies.classList.add('js-hidden')
                    this.sourceWork.classList.add('js-hidden')
                    this.sourceHealth.classList.add('js-hidden')
                    this.sourcePower.classList.add('js-hidden')
                }
            })
        })
    }

    changeBackgroundColor()
    {
        this.domainsButton.forEach((_button) =>
        {
            _button.addEventListener('click', () => 
            {
                if(_button.classList.contains('studies-button') && _button.classList.contains('js-current-button'))
                {
                    document.body.style.backgroundImage = `url("${this.backgroundImagePath}studies-background.svg")`

                } else if(_button.classList.contains('work-button') && _button.classList.contains('js-current-button'))
                {
                    document.body.style.backgroundImage = `url("${this.backgroundImagePath}work-background.svg")`

                } else if (_button.classList.contains('power-button') && _button.classList.contains('js-current-button')) 
                {
                    document.body.style.backgroundImage = `url("${this.backgroundImagePath}power-background.svg")`
                } else if (_button.classList.contains('health-button') && _button.classList.contains('js-current-button')) 
                {
                    document.body.style.backgroundImage = `url("${this.backgroundImagePath}health-background.svg")`
                } else if (_button.classList.contains('violence-button') && _button.classList.contains('js-current-button')) 
                {
                    document.body.style.backgroundImage = `url("${this.backgroundImagePath}violence-background.svg")`
                }
            })

        })

    }
}

const country = new Country()
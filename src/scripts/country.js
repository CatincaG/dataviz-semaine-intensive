class Country
{
    constructor()
    {
        // Get the 5 categories
        this.domainsButton = document.querySelectorAll('.categories a')
        console.log(this.domainsButton)
        this.studiesDomain = document.querySelector('.studies-content')
        this.workDomain = document.querySelector('.work-content')
        this.powerDomain = document.querySelector('.power-content')
        this.healthDomain = document.querySelector('.health-content')
        this.violenceDomain = document.querySelector('.violence-content')

        // Get illustrations for each category
        this.studiesIllustration = document.querySelector('img.studies-illustration')
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

        // Get background URL
        this.backgroundImagePath = "../../assets/svg/background/"

        // Rectangle
        this.rectangleStudies = document.querySelector('.rectangle-button.js-studies-rectangle')
        console.log(this.rectangleStudies)
        this.rectangleWork = document.querySelector('.rectangle-button.js-work-rectangle')
        this.rectanglePower = document.querySelector('.rectangle-button.js-power-rectangle')
        this.rectangleHealth = document.querySelector('.rectangle-button.js-health-rectangle')
        this.rectangleViolence = document.querySelector('.rectangle-button.js-violence-rectangle')

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
                initialButton.style.color = '#4F4F4F'
                initialButton.style.transition = 'all 0.3s'

                this.rectangleStudies.style.backgroundColor = '#4F4F4F' 
                this.rectangleWork.style.backgroundColor = '#4F4F4F'
                this.rectanglePower.style.backgroundColor = '#4F4F4F' 
                this.rectangleHealth.style.backgroundColor = '#4F4F4F'
                this.rectangleViolence.style.backgroundColor = '#4F4F4F'

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

                    _button.style.color = '#5941A9'
                    this.rectangleStudies.style.backgroundColor = '#5941A9'
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

                    _button.style.color = '#A9417F'
                    this.rectangleWork.style.backgroundColor = '#A9417F'
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

                    _button.style.color = '#3E9FAC'
                    this.rectanglePower.style.backgroundColor = '#3E9FAC'
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

                    _button.style.color = '#41A95E'
                    this.rectangleHealth.style.backgroundColor = '#41A95E'
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

                    _button.style.color = '#B43838'
                    this.rectangleViolence.style.backgroundColor = '#B43838'
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
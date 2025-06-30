import React from 'react'

class Home extends React.Component {
    render() {
        return (
            <div>
                <h1>Привет {this.props.name}!</h1>
                <div>Описание</div>
            </div>
        )
    }
}

export default Home
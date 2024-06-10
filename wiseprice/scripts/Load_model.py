import sys
import json
import joblib
import pandas as pd

# Load the saved model
best_model_path = 'best_car_price_predictor_GradientBoosting.pkl'
try:
    best_model = joblib.load(best_model_path)
except Exception as e:
    print(json.dumps({'error': f'Error loading model: {e}'}))
    sys.exit(1)

def main():
    try:
        # Get input features from command line arguments
        input_features = sys.argv[1:]
        
        # Create a DataFrame from input features
        new_data = pd.DataFrame([{
            'Make': input_features[0],
            'Model': input_features[1],
            'Fuel Type': input_features[2],
            'Transmission': input_features[3],
            'Registered in': input_features[4],
            'Color': input_features[5],
            'Assembly': input_features[6],
            'Body Type': input_features[7],
            'Model Year': int(input_features[8]),
            'Mileage(km)': float(input_features[9].replace(',', '')),
            'Engine Capacity(cc)': float(input_features[10].replace(',', ''))
        }])
        
        # Debug: Print new data
        debug_info = {'new_data': new_data.to_dict()}
        
        # Preprocess the new data
        new_data_preprocessed = best_model['preprocessor'].transform(new_data)
        
        # Debug: Print preprocessed data
        debug_info['preprocessed_data'] = new_data_preprocessed.tolist()
        
        # Make predictions
        predicted_prices = best_model['regressor'].predict(new_data_preprocessed)
        
        # Print the prediction as JSON
        debug_info['predicted_price'] = predicted_prices[0]
        print(json.dumps(debug_info))
    except Exception as e:
        print(json.dumps({'error': f'Error during prediction: {e}'}))

if __name__ == '__main__':
    main()

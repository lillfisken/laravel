<?php namespace market\Http\Requests;

use Illuminate\Support\Facades\Auth;
use market\Http\Requests\Request;
use market\Market;

class BidRequest extends Request {

    protected $market;

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
        //User not allowed to place bid on his/her own auction
		return $this->market->createdByUser != Auth::id();
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
        $this->market = Market::where('id', $this->input('id'))->with('bids')->first();

        if($this->market->bids->count() > 0)
        {
            //If there already are bids, set min bid to highest bid + 1
            $minBid = $this->market->bids->sortByDesc('bid')->first()->bid +1;
        }
        else
        {
            //If there are no bids, set min bid to starting price
            $minBid = $this->market->price;
        }

		return [
            'id'=> 'required|numeric',
			'bid' => 'required|numeric|min:' . $minBid,
		];
	}

    public function messages()
    {
        return [
            'bid.min' => 'Lägsta bud :min',
            'bid.required' => 'Bud saknas',
            'bid.numeric' => 'Bud måste uttryckas i siffror enbart'
        ];
    }

}
